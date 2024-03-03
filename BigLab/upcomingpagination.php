<?php for ($num=1; $num <= $total_page1; $num++) {?>
<a class="pagenumber" href="?per_page=<?php echo $page_limit?>&page=<?php echo $num?>"><?php echo $num?></a>
<?php } ?>