<?php

echo '<div id="confirmationModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Action</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to accept and forward this NOC application?</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="accept" class="btn btn-primary" id="confirmAccept">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >No</button>
            </div>
        </div>
    </div>
</div>';
//deny modal
echo '<div id="denyConfirmationModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject / Resubmit ?</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to Reject this application or ask applicant to resubmit with upload files ? </p><br>
                <div class="form-group">
                    <label for="denyReason">Reason for reject / resubmission <b class="text-danger">*</b> </label>
                    <textarea class="form-control" id="denyReason" name="denyReason" rows="3"></textarea>
                    <sub> If you choose to request resubmission, please provide clear instructions on the required additional files and any specific criteria that need to be met.</sub>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" name="deny" class="btn btn-danger confirmDeny" data-action="99_rejected" >Application Rejected</button>
                <button type="button" class="btn btn-primary confirmDeny" data-action="201_vendor_application_incomplete" >Ask applicant to resubmission</button>
                
                
            </div>
        </div>
    </div>
</div>

';
// <option value="10_vendor" data-status="201_vendor_application_incomplete">Office Assistant (CITES/Non-CITES)</option>
echo'<div id="sendBackModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Back Application</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="sendBackForm" method="POST">
                <div class="modal-body">
                    <p>Select the role to send back:</p>
                    <select name="role" class="form-control" id="sendBackRoleSelect">
                        <option>Select Option</option>
                        
                        <option value="10_Assistant" data-status="201_vendor_application_incomplete">Office Assistant (CITES/Non-CITES)</option>
                        <option value="20_Officer" data-status="401_deskofficer_verification_incomplete">Desk Officer (CITES/Non-CITES)</option>
                        <option value="30_DCF" data-status="501_DCF_verification_incomplete">Deputy Conservator of Forests (DCF)</option>
                        <option value="40_CF" data-status="601_CF_verification_incomplete">Conservator of Forests (CF)</option>
                    </select>
                    <input type="hidden" id="status" name="status" value="">
                    <input type="hidden" name="noc_id" value="',$_GET['id'],'">
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="back" class="btn btn-danger" id="confirmBack">Send Back</button>
                </div>
            </form>
        </div>
    </div>
</div>';
echo'<div id="submitChalanAgainModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Chalan Again</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to submit chalan again?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" name="submit_chalan_again" class="btn btn-primary" id="confirmSubmitChalanAgain">Yes</button>
            </div>
        </div>
    </div>
</div>


<div id="documentsNotRightModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Documents Not Right</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark documents as not right?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" name="documents_not_right" class="btn btn-primary" id="confirmDocumentsNotRight">Yes</button>
            </div>
        </div>
    </div>
</div>


<div id="incompleteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Incomplete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark application as incomplete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" name="incomplete" class="btn btn-primary" id="confirmIncomplete">Yes</button>
            </div>
        </div>
    </div>
</div>';


// echo '<script>
// $(".modal").modal();
// </script>  ';


