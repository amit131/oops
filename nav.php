<style type="text/css">
#expList ul, li {
    list-style: none;
    margin:0;
    padding:0;
    cursor: pointer;
}
#expList p {
    margin:0;
    display:block;
}
#expList p:hover {
    background-color:#121212;
}
#expList li {
    line-height:140%;
    text-indent:0px;
    background-position: 1px 8px;
    padding-left: 20px;
    background-repeat: no-repeat;
}
 
/* Collapsed state for list element */
#expList .collapsed {
    background-image: url(img/collapsed.png);
}
/* Expanded state for list element
/* NOTE: This class must be located UNDER the collapsed one */
#expList .expanded {
    background-image: url(img/expanded.png);
}

#a_load {margin: auto 50%;}
</style>

<script language="javascript">
function prepareList() {
  $('#expList').find('li:has(ul)')
  	.click( function(event) {
  		if (this == event.target) {
  			$(this).toggleClass('expanded');
  			$(this).children('ul').toggle('medium');
  		}
  		return false;
  	})
  	.addClass('collapsed')
  	.children('ul').hide();
  };

$(document).ready(function(){
	/*$('#expList').find('span').click(function(e){
    	$(this).parent().find('ul').toggle();
	});*/
	prepareList();
	
	$.ajaxSetup ({
        cache: false
    });
    var ajax_load = "<img id='a_load' src='img/load.jpg' alt='loading...' />";
     
    $(".load_basic").click(function(e){
          $("#result").html(ajax_load).load($(this).attr('id'),{test:''});
          e.preventDefault();
    });
});
</script>
<div class="dropdown">
<ul id="expList">
	<li class="collapsed">Categories
		<ul>
			<li><span><a class="load_basic" id="/u_custom/category/newCat" href="#">New Category</a></span></li>
			<li><span><a class="load_basic" id="/u_custom/category/listCats" href="#">List Categories</a></span></li>
		</ul>
	</li>
	<li><span>Products</span></li>
	<li><span>Customers</span></li>
	<li><span>Orders</span></li>
</u>
</div>