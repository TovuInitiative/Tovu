

<style type="text/css">
.agileits_search{
	float: right;
    width: 100%;
    margin: 1.2em 0 0;
	position: relative;
}
.agileits_search input[type="text"],#agileinfo_search{
	outline:none;
	border:1px solid #999;
	background:#fff;
	color:#999;
	padding:10px;
	font-size:14px;
	float:left;
}
.agileits_search input[type="text"]{
	width: 100%;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
	border-radius: 20px;
	height: 40px;
	padding-right: 70px;
}
#agileinfo_search{
	width: 23%;
    background: #EBEBEB;
    border-left: none;
	padding:10.5px 10px;
}
.agileits_search input[type="submit"]{
	outline: none;
    border: none;
    background:#ff5000;
    color: #fff;
    padding: 10px 0;
    font-size: 1em;
    width: 60px;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
	position: absolute;
	top: 0px; right: 0px;
	margin: 0;
}
.agileits_search input[type="submit"]:hover{
	background:#39bd00;
}
</style>
<div class="agileits_search">
	<form action="search.php" method="get" class="">
		<input name="searchtext" id="searchtext" type="text" placeholder="Search" maxlength="50" required="required">
		<input type="submit" value="Search">
	</form>
</div>
