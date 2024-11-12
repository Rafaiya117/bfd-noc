<style>
.active {
  background-color: yellow;
}
.navbar{
  border:0.1em solid #e0e0e0;
 margin:0 0.3em 0.3em 0.3em 0.3em;
 border-radius:0.12em;  
 box-sizing: border-box;

}
</style>

<div class="topnav">
  <a class="navbar active" href=".././dashboard.php">Home</a>
  <!-- <a class="navbar" href="./all_list.php">All NOCs</a> -->
  <!-- <a class="navbar" href="./import.php">Create NOC</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=draft">Drafts</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=200_vendor_submitted">New NOC Application</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=300_initial_document_verification"></a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=400_deskofficer_verification">Desk Officer</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?role=20_officer">Desk Officer</a>
  <a class="navbar" href="./list_of_nocs.php?status=50_DCF">DCF</a>
  <a class="navbar" href="./list_of_nocs.php?status=60_CF">CF</a>
  <a class="navbar" href="./list_of_nocs.php?status=70_CCF">CCF</a>
  <a class="navbar" href="./list_of_nocs.php?status=800_waiting_for_vendor_payment">Waiting for Payment</a>
  <a class="navbar" href="./list_of_nocs.php?status=850_payment_check">Check Payment Status</a>
  <a class="navbar" href="./list_of_nocs.php?status=900_payment_confirmed">Waiting for Final Approval</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=1000_signed_document">Approved NOCs</a> -->
  <!-- <a class="navbar" href="./list_of_nocs.php?status=99_rejected">Rejected NOCs</a> -->
  <!-- <a class="navbar" href="./list_of_vendor.php">Vendor List</a> -->
  
  <!-- <a href="./details.php">NOC detail-page</a> -->
  <div class="search-container">
    <form action="search_imp_list.php" method="POST" style="background:transparent">
    <!-- <input type="text" name="memo_id" id="memo_id" placeholder="search">
      <button type="submit" id="find"><i class="fa fa-search"></i></button> -->
      <!-- <input id="find" class="btn btn-lg btn-primary" type="submit" value="Search"> -->
    </form>
  </div>
</div>
<?php
echo'<div style="float:right;padding-right:10px;"><a href="../user_profile.php?id=',$_SESSION['id'],'">My Profile</a>&nbsp;| <a href="../logout.php?id=', $_SESSION['id'],'">Logout</a></div><br>';
?>

1