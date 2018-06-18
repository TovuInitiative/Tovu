<div class="row">
<form action="search.php?tk=<?php echo time(); ?>" method="get" class="">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
        <input type="text" name="searchtext" id="searchtext" class="form-control search-control txt15 txtcenter" placeholder="Search Maarifa..." value="<?php echo @$request['searchtext']; ?>">
        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
    </div>
</form>
</div>