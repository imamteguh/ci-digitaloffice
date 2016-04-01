<div class="col-md-11">
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
        <li><a href="<?php echo site_url('forum')?>">Forum Kategori</a></li>
        <li>Sub Forum Kategori</li>
    </ul>
</div>
<div class="col-md-11">
    
    <div class="kategoriforum">
        <div class="icon-forum">
            <img src="<?php echo base_url()?>uploads/forum/icon/<?php echo $kategori['ktforum_icon'] ?>" width="60">
        </div>
        <div class="title-forum">
            <h1><?php echo $kategori['ktforum_judul'] ?></h1>
            <p><?php echo $kategori['ktforum_keterangan'] ?></p>
        </div>
        <div class="clear-fix"></div>
    </div>
    <div class="breadforum">
        <p class="bread1">Subforum: <?php echo $kategori['ktforum_judul'] ?></p>
        <p class="bread2">Stats</p>
        <p class="bread3">Last Comment</p>
        <div class="clear-fix"></div>
    </div>
    <?php
    if($subkategori) {
        foreach ($subkategori->result() as $subrow) {
    ?>
    <div class="listforum">
        <div class="kiri">
            <p class="link"><a href="<?php echo site_url('forum/addview/'.$subrow->ktforum_id) ?>"><?php echo $subrow->ktforum_judul ?></a></p>
            <p><?php echo $subrow->ktforum_keterangan ?></p>
        </div>
        <div class="tengah">
            <p>Replies: <strong><?php echo replies($subrow->ktforum_id) ?></strong></p>
            <p>Views: <strong><?php echo $subrow->ktforum_view ?></strong></p>
        </div>
        <?php echo last_coment($subrow->ktforum_id) ?>
        <div class="clear-fix"></div>
    </div>
    <?php
        }
    }
    ?>

    
</div>