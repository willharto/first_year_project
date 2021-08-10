<!DOCTYPE html>
<html>
<head>
<style>
#viewpdf{
  width: 100%;
  height: 500px;
  border: 1px solid rgba(0,0,0,.2);
}
</style>
</head>

<body>

<script src="jquery.min.js"></script>
<script src="pdfobject.min.js"></script>
<script>
var viewer = $('#viewpdf');
PDFObject.embed('test.pdf', viewer);
</script>
</body>

</html>
