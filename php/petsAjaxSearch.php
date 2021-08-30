<?php
session_start();
require_once "../includes/db_config.php";
if(isset($_POST["search"]) && !($_POST["search"]) == 0)
{
    $searchVariable = $_POST['search'];
    $sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status s ON pets.statusId = 
    s.statusId WHERE type LIKE :type OR age LIKE :age OR status LIKE :status OR active LIKE :active";

    $sqlQuery2=$connect->prepare($sqlCommand2);
    $sqlQuery2->bindValue(':type', '%'.$searchVariable.'%');
    $sqlQuery2->bindValue(':age', '%'.$searchVariable.'%');
    $sqlQuery2->bindValue(':status', '%'.$searchVariable.'%');
    $sqlQuery2->bindValue(':active', '%'.$searchVariable.'%');
    $sqlQuery2->execute();
    $i=0;
    $count=0;
    while($row = $sqlQuery2->fetch(PDO::FETCH_ASSOC)) 
    {
        $i++;
        $count++;
        $id=$row["id"];
        $type=$row["type"];
        $status=$row["status"];
        $petAge=$row["age"];
        $image=$row["image"];
        $description=$row["description"];
        $active = $row["active"];
        if($active == 0)
        {
            $isActive = "Örökbefogadott";
            echo "
                <div class='pet'>";
                if(isset($_SESSION["email"]))
                {
                    echo"
                    <form method='post' class='submitForm'>";
                    $userId = $_SESSION['email'];
                    $sqlGetID = "SELECT id FROM signedup WHERE email = :email";
                    $result = $connect->prepare($sqlGetID);
                    $result->bindValue(":email",$userId);
                    $result->execute();
                    $row = $result->fetch();
                    $id2 = $row["id"];
                    
                    echo"
                    <input value='$id' type='hidden' name='favorite'>
                    </form>
                        ";
                }
                echo"
                <div class='pet-advertisement-caption'>
                    Állat fajtája: $type<br>
                    Állapota: $status<br>
                    Életkor: $petAge<br>
                    Aktív-e: <span class='activeOrNot2'>$isActive</span>
                </div>
                    <a href='petDescription.php?id=$id'><img class='img1' src='../images/animals/$image' alt='hírdetés'></a>
                </div>
                <script>
                
                for(let i = 0; i<document.querySelectorAll('.activeOrNot2').length; i++)
                {
                    if(document.querySelectorAll('.activeOrNot2')[i].innerHTML == 'Örökbefogadott')
                    {
                        document.querySelectorAll('.activeOrNot2')[i].style.color='#f05';
                        document.querySelectorAll('.pet')[i].style.backgroundColor='#54626F';
                        document.querySelectorAll('.pet-advertisement-caption')[i].style.marginTop='30px';
                        document.querySelectorAll('.pet-advertisement-caption')[i].style.boxShadow='0 0 10px #54626F';
                        document.querySelectorAll('.img1')[i].style.filter='grayscale(100%)';
                    }
                }
                </script>";
                if($i==2)
                {
                    echo "<h6></h6>";
                    $i=0;
                }
        }
        else if($active == 1)
        {
            $isActive = "Elérhető";
            echo "
            <div class='pet'>";

        if(isset($_SESSION["email"]))
        {
            echo"
            <form method='post' class='submitForm'>";
            $userId = $_SESSION['email'];
            $sqlGetID = "SELECT id FROM signedup WHERE email = :email";
            $result = $connect->prepare($sqlGetID);
            $result->bindValue(":email",$userId);
            $result->execute();
            $row = $result->fetch();
            $id2 = $row["id"];
            
            $sql3 = "SELECT * FROM users_pets WHERE userID = ".$id2." AND petID = ".$id;
            $q2 = $connect->prepare($sql3);
            $q2->execute();
            if($q2->rowCount()==1)
            {
                echo "<input type='image' class='star-img' alt='star' src='../images/star.png'>";
            }
            else
            {
                echo "<input type='image' class='star-img' alt='star' src='../images/star2.png'>";
            }
            
            echo"
            <input value='$id' type='hidden' name='favorite'>
            </form>
            ";
        }
             echo"
            <div class='pet-advertisement-caption'>
                Állat fajtája: $type<br>
                Állapota: $status<br>
                Életkor: $petAge<br>
                Aktív-e: <span class='activeOrNot2'>$isActive</span>
            </div>
                <a href='petDescription.php?id=$id'><img class='img1' src='../images/animals/$image' alt='hírdetés'></a>
            </div>
            <script>
            for(let i = 0; i<document.querySelectorAll('.activeOrNot2').length; i++)
            {
                if(document.querySelectorAll('.activeOrNot2')[i].innerHTML == 'Elérhető')
                {
                    document.querySelectorAll('.activeOrNot2')[i].style.color='#cf0';
                    document.querySelectorAll('.pet-advertisement-caption')[i].style.marginTop='30px';
                }
            }
            </script>";
            if($i==2)
            {
                echo "<h6></h6>";
                $i=0;
            }

        }
    }
    echo "<div class='counter'>Állatok száma: $count</div>";
}
if(isset($_POST['favorite']))
{
    $id = $_POST['favorite'];
    $userId = $_SESSION['email'];

    $sqlGetID = "SELECT id FROM signedup WHERE email = :email";
    $result = $connect->prepare($sqlGetID);
    $result->bindValue(":email",$userId);
    $result->execute();
    $row = $result->fetch();
    $id2 = $row["id"];



    $sql3 = "SELECT * FROM users_pets WHERE userID = ".$id2." AND petID = ".$id;
    $q2 = $connect->prepare($sql3);
    $q2->execute();
    if($q2->rowCount()==0)
    {
        $id2 = $row["id"];
        $id = $_POST['favorite'];
        $sql = "INSERT INTO users_pets(userID,petID) VALUES(:uId, :pID)";
        $query=$connect->prepare($sql);
        $query->bindValue(":uId",$id2);
        $query->bindValue(":pID",$id);
        $query->execute();
        echo "
        <script>
        let star = document.querySelectorAll('.star-img');
        star[0].src='images'/star.png';
        </script>		
        ";
    }
    else
    {
        $row = $q2->fetch();
        $petId = $row["petID"];
        $userId = $row["userID"];
        $sql = "DELETE FROM users_pets WHERE petID = :pID AND userID = :uID";
        $q3 = $connect->prepare($sql);
        $q3->bindValue(":pID",$petId);
        $q3->bindValue(":uID",$userId);
        $q3->execute();
        echo "
        <script>
        let star = document.querySelectorAll('.star-img');
        star[0].src='images'/star2.png';
        </script>		
        ";
    }
    echo "
    <script>
    window.location='pets.php';

    let ac = document.querySelectorAll('.activeOrNot2');

    </script>
    ";
}



?>