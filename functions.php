<?php
function prx($data)
{
    echo '<pre>';
    print_r($data);
    die();
}

function get_safe_value($data) 
{
    global $conn;
    if($data)
    {
        return mysqli_real_escape_string($conn, $data);
    }
}

function redirect($link)
{
    ?>
    <script>
        window.location.href='<?php echo $link ?>';
    </script>
    <?php
}

function checkUser()
{
    if(isset($_SESSION['UID']) && $_SESSION['UID'] != '')
    {
        
    }
    else
    {
        redirect('index.php');
    }
}