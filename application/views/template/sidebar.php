<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <?php foreach ($dataMenu as $key => $value): ?>
          <li>
            <?php echo $value->IconSidebar; 
            $CI =& get_instance();
            $CI->load->model('m_login');
            $dataUser=$this->session->userdata('dataUser'); 
            ?> 
            <?php if (count($CI->m_login->getMenu2($value->IdMenu,$dataUser['Role'])>0)): ?>
              <ul class="treeview-menu">          
              <?php foreach ($CI->m_login->getMenu2($value->IdMenu,$dataUser['Role']) as $key => $value2): ?>            
                  <?php echo $value2->IconSubSidebar; ?>
              <?php endforeach ?>
              </ul>
            <?php endif ?>
          </li>
        <?php endforeach ?> -->
        <li><a href="Item"><i class="fa fa-archive"></i> <span>Item</span></a></li>
        <li><a href="Customer"><i class="fa fa-user"></i> <span>Customer</span></a></li>
        <li><a href="Sales"><i class="fa fa-cart-plus"></i> <span>Sales</span></a></li>
        <li><a href="Home/signout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>

      </ul>
    </section>
  </aside>