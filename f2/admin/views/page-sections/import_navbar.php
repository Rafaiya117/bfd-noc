<div class="topnav">
  <a class="navbar active" href=".././dashboard.php">Home</a>
  <a class="navbar" href="./list_of_nocs.php?role=10_Assistant"> Office Assistant</a>
  <a class="navbar" href="./list_of_nocs.php?role=20_Officer">Desk Officer</a>
  <a class="navbar" href="./list_of_nocs.php?role=30_DCF">DCF</a>
  <a class="navbar" href="./list_of_nocs.php?role=40_CF">CF</a>
  <a class="navbar" href="./list_of_nocs.php?role=50_CCF">CCF</a>
  <a class="navbar" href="./list_of_nocs.php?status=800_waiting_for_vendor_payment">Waiting for Payment</a>
  <a class="navbar" href="./list_of_nocs.php?status=1000_signed_document">Approved NOCs</a>
  <a class="navbar" href="./list_of_nocs.php?status=99_rejected">Rejected NOCs</a>
  <a class="navbar" href="./list_of_nocs.php">All NOCs</a>

  <div class="search-container">
    <form action="search_imp_list.php" method="POST" style="background:transparent">
    <!-- <input type="text" name="memo_id" id="memo_id" placeholder="search">
      <button type="submit" id="find"><i class="fa fa-search"></i></button> -->
      <!-- <input id="find" class="btn btn-lg btn-primary" type="submit" value="Search"> -->
    </form>
  </div>
</div>
    <?php // echo'<div style="float:right;padding-right:20px;"><a href="../user_profile.php?id=',auth()['id'],'">My Profile</a>&nbsp;| <a href="../logout.php?id=',auth()['id'],'">Logout</a></div>';?>
    