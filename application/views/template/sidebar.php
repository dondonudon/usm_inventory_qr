<section class="sidebar">
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
       
        
        <?php
        // chek settingan tampilan menu
        $setting = $this->db->get_where('tbl_setting',array('id_setting'=>1))->row_array();
        if($setting['value']=='ya'){
            // cari level user
            $id_user_level = $this->session->userdata('id_user_level');
            $sql_menu = "SELECT * 
            FROM tbl_menu 
            WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level=$id_user_level) and is_main_menu=0 and is_aktif='y' ORDER BY urutan ASC";
        }else{
            $sql_menu = "select * from tbl_menu where is_aktif='y' and is_main_menu=0";
        }

        $main_menu = $this->db->query($sql_menu)->result();
        
        foreach ($main_menu as $menu){
            // chek is have sub menu
            $this->db->where('is_main_menu',$menu->id_menu);
            $this->db->where('is_aktif','y');
            $this->db->order_by('urutan','ASC');
            $submenu = $this->db->get('tbl_menu');
            $tree = 'treeview';
            if($submenu->num_rows()>0){
                // display sub menu
                $url = $this->uri->segment(1);
                $sql = $this->db->query("SELECT * FROM tbl_menu WHERE url = '$url' ");
                $result = $sql->row();
                $parent = $result->is_main_menu;
                
                if ($menu->id_menu == $parent) {
                    echo "<li class = 'treeview active'>";
                } else{
                    echo "<li class = 'treeview'>";
                }
                echo    "<a href='#'>
                            <i class='$menu->icon'></i> <span>".strtoupper($menu->title)."</span>
                            <span class='pull-right-container'>
                                <i class='fa fa-angle-left pull-right'></i>
                            </span>
                        </a>
                        <ul class='treeview-menu'>";
                        foreach ($submenu->result() as $sub){
                            if ($this->uri->segment(1)==$sub->url) {
                                echo "<li class='active'>".anchor($sub->url,"<i class='$sub->icon'></i> ".strtoupper($sub->title))."</li>";
                            } else {
                                echo "<li>".anchor($sub->url,"<i class='$sub->icon'></i> ".strtoupper($sub->title))."</li>";
                            }
                        }
                        echo" </ul>
                    </li>";
            }else{
                // display main menu
                if($this->uri->segment(1)==$menu->url){
                        echo "<li class='active'>";
                        echo anchor($menu->url,"<i class='".$menu->icon."'></i> ".strtoupper($menu->title));
                        echo "</li>";
                    }else{
                        echo "<li>";
                        echo anchor($menu->url,"<i class='".$menu->icon."'></i> ".strtoupper($menu->title));
                        echo "</li>";
                    }
            }
        }
        ?>
        <li><?php echo anchor('auth/logout',"<i class='fa fa-sign-out'></i> LOGOUT");?></li>
    </ul>
</section>
<!-- /.sidebar -->