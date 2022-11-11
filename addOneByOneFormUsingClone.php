<link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <title>Clone forms</title>
</head>
<body>
<div class="container">
  <div class="row">
  <div class="col-xs-12">
    <form class="form-main">
      <div class="form-block">
        <div class="form-group">
          Name
        <input type="text" name="name[]" class="form-control">
        </div>
        <div class="form-group">
          Email
        <input type="text" name="email[]" class="form-control">
        </div>
        <hr>
      </div>
    </form>
    <a class="btn btn-primary add-more-btn">Add one</a>
  </div>
</div>
</div>
<script>
var template = $(".form-block").clone();
var form = $(".form-main");

$('.add-more-btn').on('click',function() {
   var newFormBlock = template.clone(); // Clone again here, to be able to append more than once.
   form.append(newFormBlock);
});

</script>