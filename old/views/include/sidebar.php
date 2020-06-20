<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('img/pengguna.png')?>" class="img-circle" alt="User Image" style="height: 45px">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nmPengguna')?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MENU</li>
            <li id="dashboard"><a href="<?php echo site_url('dashboard')?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

            <?php 
                $menu = $this->session->userdata('menu');
                for ($i=0; $i < count($menu); $i++) { 
                    if ($menu[$i][0]['kdMenu'] == $menu[$i][0]['parentMenu']) {
                        echo "<li id='".$menu[$i][0]['kdMenu']."'><a href='".site_url($menu[$i][0]['kdMenu'])."'><i class='fa ".$menu[$i][0]['iconMenu']."'></i>".$menu[$i][0]['nmMenu']."</span></a>";
                    }else{                        
                        $parent = $menu[$i][0]['kdMenu'];
                        echo "<li class='treeview' id='".$parent."'>";
                        echo "<a href='#'><i class='fa ".$menu[$i][0]['iconMenu']."'></i><span>".$menu[$i][0]['nmMenu']."</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span></a>";
                        echo "<ul class='treeview-menu'>";
                        for ($j=1; $j < count($menu[$i]); $j++) {
                            echo "<li id='".$menu[$i][$j]['kdMenu']."' class='".$parent."'><a href='".site_url(''.$menu[$i][$j]['kdMenu'])."'><i class='fa fa-circle-o'></i>".$menu[$i][$j]['nmMenu']."</a></li>";
                        }
                        echo "</ul>";
                    }
                    echo "</li>";
                }
            ?>
        </ul>
    </section>
</aside>
