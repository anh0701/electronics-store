@if ($paginator->hasPages())

<div class="row">
    <div class="col-sm-7 text-right text-center-xs">                
      <ul class="pagination pagination-sm m-t-none m-b-none">
        <li class="page-item"><a href=""><i class="fa fa-chevron-left"></i></a></li>
        <li class="page-item"><a href="">1</a></li>
        <li class="page-item"><a href="">2</a></li>
        <li class="page-item"><a href="">3</a></li>
        <li class="page-item"><a href="">4</a></li>
        <li class="page-item"><a href=""><i class="fa fa-chevron-right"></i></a></li>
      </ul>
    </div>
</div>

@endif