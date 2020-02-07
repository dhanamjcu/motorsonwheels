<section class="container-fluid footer-content">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="md-col-3">
               <img src="bootstrap/img/logo.png" alt="logo" id="footer-logo" >
            </div>
            <div class="md-col-3">
                <h5>Car For Sale</h5>
                <ul>
                    <li><a href="posts.php">All Cars</a></li>
                    <li><a href="posts.php?condition=new">New cars for sale</a></li>
                    <li><a href="posts.php?condition=used">Used cars for sale</a></li>
                   
                </ul>

            </div>
            <div class="md-col-3">
                <h5>Quick Link</h5>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="posts.php">Privacy</a></li>
                    <li><a href="#">About Us</a></li>
                    
                </ul>

            </div>
            <div class="md-col-3">
                <h5>Contact Us</h5>
                

                <address>
                    <strong>Motor On Wheels, Inc.</strong><br>
                    <a type="button" class="btn-link" data-toggle="modal" data-target="#FooterenquiryModal" data-whatever="@mdo">Contact Us</a>
                   <!--  34 Henry Street<br>
                    MOUNT DUNEED,Victoria 3216<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890<br>
                    <a href="mailto:first.last@example.com">first.last@example.com</a> -->
                </address>
                

            </div>
        </div>
    </div>
</section>
<div class="d-flex justify-content-center p-2" id="copy-right">&copy; Motor On Wheels, 2019-<?php echo date('Y')?> </div>



<!-- //enquiry model -->

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enquiryModal" data-whatever="@mdo">Open modal for @mdo</button>  -->


<div class="modal fade" id="FooterenquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <input type="hidden" value=""  class="advalue" name="adId">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Email:</label>
            <input type="email" class="form-control" id="recipient-name" name="email">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your Phone:</label>
            <input type="text" class="form-control" id="recipient-name" name="contact">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" name="enqSubmit">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>
