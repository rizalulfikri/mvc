<?php
        require '../model/sekolah.php'; 
        session_start();             
        $sporttb=isset($_SESSION['sporttbl0'])?unserialize($_SESSION['sporttbl0']):new sekolah();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Olahraga</h2>
                    </div>
                    <p>Isilah form untuk menambahkan data pada database</p>
                    <form action="../index.php?act=add" method="post" >
                        <div class="form-group <?php echo (!empty($sporttb->category_msg)) ? 'has-error' : ''; ?>">
                            <label>Kategori Olahraga</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $sporttb->category; ?>">
                            <span class="help-block"><?php echo $sporttb->category_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sporttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Cabang Olahraga</label>
                            <input name="name" class="form-control" value="<?php echo $sporttb->name; ?>">
                            <span class="help-block"><?php echo $sporttb->name_msg;?></span>
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Batal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>