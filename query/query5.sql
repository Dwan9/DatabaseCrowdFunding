/* query 5 */
/* List all comments by users that are followed by user ‘‘BobInBrooklyn’’ */
select comment.description
from comment, follower
where follower.funame = 'BobInBrooklyn' and
	follower.uname = comment.uname;