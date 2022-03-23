<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <?= $head ?>
</head>


<body id="buordly" data-url="<?= ROOTURL ?>">
  <script>
    var ROOTURL = document.getElementById('buordly').getAttribute('data-url');
  </script>

  {{content}}
  <!-- Footer -->

  <script src="<?= ROOTURL ?>/public/assets/js/app.js"></script>
</body>

</html>