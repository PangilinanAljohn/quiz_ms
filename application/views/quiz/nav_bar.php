<!-- Menu -->
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
          <div class="image">
              <img src="images/user.png" width="48" height="48" alt="User" />
          </div>
          <div class="info-container">
              <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
              <div class="email">john.doe@example.com</div>
              <div class="btn-group user-helper-dropdown">
                  <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                  <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                      <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- #User Info -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo site_url();?>">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('quiz/respondents');?>">
                    <i class="material-icons">people</i>
                    <span>Respodents</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('quiz/manage_quiz');?>">
                    <i class="material-icons">assignment</i>
                    <span>Quizzes</span>
                </a>
            </li>


        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 <a href="javascript:void(0);">Quiz Management System</a>
        </div>
    </div>
    <!-- #Footer -->
  </aside>
</section>
