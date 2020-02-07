<?php

       //echo 'getting';
        $category       =  $_POST['category'];
        $address        =  $_POST['address'];
        $min_price      =  $_POST['min-price'];
        $max_price      =  $_POST['max-price'];
        $bedrooms       =  $_POST['bedrooms'];
        $bathrooms      =  $_POST['bathrooms'];
        $type           =  $_POST['type'];
   


    $query = "SELECT * FROM `property-list`";
                
                $conditions = array();
                
                if(!empty($category)){
                $conditions[] = "category='$category'";
                }
                if(!empty($address)) {
                $conditions[] = "address LIKE '%$address%'";
                }
                if(!empty($type)) {
                $conditions[] = "type='$type'";
                }
                if(!empty($min_price && $max_price)) {
                $conditions[] = "`price` BETWEEN $min_price AND $max_price";
                }
                if(!empty($min_price) &&  empty($max_price)) {
                $conditions[] = "price=$min_price";
                } 
                if(!empty($bedrooms)) {
                $conditions[] = "bedrooms='$bedrooms'";
                }
                if(!empty($bathrooms)) {
                $conditions[] = "bathrooms='$bathrooms'";
                }
                
                $sql = $query;
                if (count($conditions) > 0) {

                $sql .= " WHERE " . implode(' AND ', $conditions );
                
                }
            
               // echo $sql;exit;
                $result = mysqli_query($conn, $sql);

                           
           






?>