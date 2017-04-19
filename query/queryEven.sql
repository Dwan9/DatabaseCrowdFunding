-- query2
select * from project 
where pname like '%jazz%' and status = 'wait'
order by startdate desc;

-- query4
select uname from 
(select uname,count(*) as c
from project where rate >4
group by uname
having c>3) as T;

-- query6
insert into project(`pid`, `uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`)
values (psequence.NEXTVAL, 'Duan', current_timestamp, '2018-01-01 00:00:00', 10000, 50000, 0, 'New Jazz Album', 'WAIT');

-- query8
-- insert new sponsor->increase curAmount
delimiter /
drop trigger if exists updatePamount;
/
create trigger updatePamount after insert on sponsor
for each row begin
if new.amount!=null then 
update project
set project.curAmount = project.curAmount + new.amount
where project.pid=new.pid;
end if;
end;
/

-- reach minAmount->project.status=FUNDED
-- reach maxAmount->project.status=FULL
drop trigger if exists updatePstatus;
delimiter /
create trigger updatePstatus before update on project
for each row begin
if new.curAmount>new.minAmount and new.`status`='FUNDING' then 
set new.`status` = 'FUNDED';
end if;
if new.curAmount>new.maxAmount and new.`status`='FUNDED' then 
set new.`status` = 'FULL';
end if;
end;
/

-- event current day=endDate and status=FUNDING->stauts=FAIL
drop event if exists projectFail;
SET GLOBAL event_scheduler = 1; 
delimiter /
create event projectFail
on schedule every 1 day
ON  COMPLETION  PRESERVE  
enable
do begin
update project
set `status`='FAIL'
where endDate<=current_timestamp and `status`='FUNDING';
end;
/
-- kouqian trigger

-- insert sponsor.rate->project.rate=select avg(rate) from sponsor where pid = group by pid
drop trigger if exists updateRate;
delimiter /
create trigger updateRate after update on sponsor
for each row begin
declare newrate decimal(10,2);
if new.rate!= old.rate then
select avg(rate) 
into newrate
from sponsor 
where sponsor.pid=new.pid 
group by sponsor.pid;
update project
set rate=newrate
where pid = new.pid;
end if;
end;
/
delimiter ;

-- 未经试验


