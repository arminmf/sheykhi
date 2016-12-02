فیلترشده
<br><br>
<?php
for ($i=0;$i < count($arr); $i++ ){
    $project_single = \App\Project::where("id",$arr[$i])->get();
}
?>

@foreach($project_single as $item)
    <?php
    /*$img = \App\Image::where('project_id',$item['id'])->where('main',1)->get();
    foreach ( $img as $it) {
        $img_addr=$it->img_name;
    }*/
    ?>
    <div class="item prj_item">
        <a href="{{ url("project/".$item['title']) }}">
            <img src="{{ asset('resources/upload/images/') }}">
            <h4>{{ $item['title'] }}</h4>
            <h5>{!!  mb_substr($item['des'], 0, 200) !!}...</h5>
        </a>
    </div>
    <?php //$img_addr=""; ?>
<<<<<<< HEAD
@endforeach
=======
    @endforeach


>>>>>>> 79790108f7a88026f6c2af01926f7d1ffd49ab75
