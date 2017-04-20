/* query 3 */
/* List all users who have given money for projects containing the tag or category ‘jazz’
 in the past,sorted by the total amount they have successfully pledged (meaning, money that
 was actually charged). */
 
select distinct sponsor.uname
from sponsor, project
where pledgeStatus = 'CHARGED' and
	(project.tags like '%jazz%' or pname like '%jazz%')
order by sponsor.amount;