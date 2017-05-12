function AntiSqlInject(oField)
{
re= /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
if ( re.test(oField.value) )
{
alert("Please do not type special characters or SQL query!");
oField.value = "";
oField.className="errInfo";
oField.focus();
return false;
}
}