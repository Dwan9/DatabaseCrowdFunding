function testValue(oField){
			re= /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
			if ( re.test(oField.value) ){
			alert("Please do not type special characters or SQL query!");
			oField.value = "";
			oField.className="errInfo";
			oField.focus();
			return false;}
			var v = oField.value;
			var len = v.length;
			for (var i=0;i<len;i++){
				if(v.charAt(i)>"9"|| v.charAt(i)<"0")
				{
					alert("Please enter a number!");
					oField.value = "";
					oField.focus();
					oField.className="errInfo";
					return false;
				}
			}
		}