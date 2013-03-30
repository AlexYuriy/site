var base_url = "http://istochnik-spb.com/main.php?year=";

var month_name = [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль" , "Август", "Сентябрь", "Октябрь", "Ноябрь" ,"Декабрь" ];

function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}

function get_start_day()
{
	now.setDate(1);
	var ret = now.getDay();
	if (ret == 0) ret = 7;
	return ret;
}
function get_end_day ()
{
	var month_n = now.getMonth();
	var year_n = now.getFullYear();
	if (month_n == 1) {	if (year_n % 4) return 28;	else return 29; }
	if (month_n < 7)
	{	 if (month_n % 2){return 30;} else {	return 31;}	}
	else if (month_n % 2) {	return 31;} else { return 30;}	
}
function redraw()
{

	var date_n = 0;
	var start = get_start_day();
	var finish = get_end_day();
	for (var i = 1; i < start; ++i) 
		{
			getObj(i).innerHTML = "";
			getObj(i).bgColor = color_free;
		}
	for (var i = start; i < 43; ++i) 
	{	++date_n;
		var Obj_id = getObj(i) ;
		if (( date_n > 0)&& (date_n <= finish))
		{
			var  month_n = now.getMonth() +1 ;
			var  year_n = now.getYear() +1900;

		
			var flag =0;
			for (var d = 0; (d < good_Date.length); ++d) 
			{

				if  (	( date_n == good_Date[d] )
					&&  ( month_n == good_Month[d] ) 
					&&  ( year_n == good_Year[d] ))
						flag = 1	;
			}
			if (flag == 0) 
			{
				Obj_id.innerHTML = date_n;	
				Obj_id.bgColor = color_no;
			}
			else 
			{
				Obj_id.innerHTML = "<a href="+ base_url + year_n + "&today=" + date_n + "&month=" + month_n+">" + String( date_n ) + "</a>";		
				Obj_id.bgColor = color_yes;
			}
				 
			if ( ((finish == 31) && (start > 5)) ||((finish == 30) && (start > 6)) ) getObj("last_week").style.display='';
				else getObj("last_week").style.display='none';
				
			if ((finish == 28) && (start == 1)) 	getObj("pre_last_week").style.display='none';
				else getObj("pre_last_week").style.display='';
		}
		else 
		{
			Obj_id.bgColor = color_free;
			Obj_id.innerHTML = "";
		}
	}
	getObj("month").innerHTML = month_name [now.getMonth()] +" "+ String(now.getFullYear()) ;
	getObj("back").href = base_url + String(now.getYear()+1900) + "&today=0&month=" + String(now.getMonth());	
	getObj("forward").href = base_url + String(now.getYear()+1900) + "&today=0&month=" + String(now.getMonth()+2);
}
function month(a)
{	
	var month_n = now.getMonth();
	var year_n = now.getFullYear();
	month_n +=a;

	if (month_n < 0) month_n = 11, --year_n;
	if (month_n > 11) month_n = 0, ++year_n;

	now.setMonth(month_n);
	now.setFullYear(year_n);
	redraw();
}

