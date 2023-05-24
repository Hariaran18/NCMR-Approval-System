<?php

    include ("../config/dbconnection.php");
    
    // Material
    if(isset($_POST['material'])){
        $material = $_POST['material']; 
    }else{
        $material = "";
    }
    // Size x
    if(isset($_POST['size_x'])){
        $size_x = $_POST['size_x']; 
    }else{
        $size_x = "";
    }
    // Size y
    if(isset($_POST['size_y'])){
        $size_y = $_POST['size_y']; 
    }else{
        $size_y = "";
    }
    // Thickness
    if(isset($_POST['thickness'])){
        $thickness = $_POST['thickness']; 
    }else{
        $thickness = "";
    }

    if (($material != "") && ($size_x != "") && ($size_y != "") && ($thickness != "")) {
        // Get material values from scrap_cost table
        $sql = mysqli_query($conn,"SELECT * FROM scrap_cost WHERE material = '".$material."'");
        $sql_qry = mysqli_fetch_assoc($sql);
        $price = $sql_qry['price'];
        $density = $sql_qry['density'];
        $raw_x = 2438;
        $raw_y = 1219;

        // Calculate cost
        $area = $size_x*$size_y*2/1000000;
        $weight = ($thickness*$size_x*$size_y*$density)/1000000;
        $material_cost = ($price/1000)*($density*$thickness*$raw_x*$raw_y/1000000);
        // $unit_cost = ($material_cost/round($raw_x/($size_x+10),2)*round($raw_y/($size_y+10)));
        $x = floor($raw_x/($size_x+10));
        $y = floor($raw_y/($size_y+10));
        $unit_cost = $material_cost/($x*$y);

        // Send result to form.php
        echo round($unit_cost,2);
    } else {
        echo "";
    }
 
?>