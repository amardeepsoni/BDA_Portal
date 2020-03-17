<div class="container">
    <h1>School Detials</h1>
    <form action="uploaded_school" method="POST">
        <div class="form-group">
            <label for="name">School Name</label>
            <input required type="text" class="form-control" id="name" name="name" aria-describedby="Help" placeholder="Enter School Name">
        </div>
        <div class="form-group">
            <label for="school address"> School Address</label>
            <input required type="text" class="form-control" id="school address" name="address" aria-describedby="Help" placeholder="Enter school address">
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input required type="phone number" class="form-control" id="contact" name="contact" aria-describedby="Help" placeholder="Enter conatct details">
        </div>
        <div class="form-group">
            <label for="cPerson">Contact Person Name</label>
            <input required type="text" class="form-control" id="cPerson" name="cPerson" aria-describedby="Help" placeholder="Enter contact person's name">
        </div>
        <button class="btn btn-primary btn-block btn-lg" type="submit">Submit Details</button>
    </form>
</div>