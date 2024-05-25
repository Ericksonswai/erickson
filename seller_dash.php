<?php
    session_start();
    include('../conn.php');

    if(empty($_SESSION['sellerName']))
    {
        echo '<script>
            window.location.href="seller_login.html";
            alert("LOGIN TO CONTINUE");
        </script>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/icons/logo3.png">
    <!-- external css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
</head>
<body class="bg-slate-900">

    <!-- HEADER -->
    <div class="header bg-slate-800 flex flex-row items-center justify-between p-3 py-5 w-[100%] top-[0px] fixed shadow-lg">
        <div class="flex flex-row items-center">
            <img src="../assets/icons/logo4.png" class="w-[150px] md:w-[200px]">
        </div>
        <div class="flex flex-col-reverse md:flex-row md:items-center items-end gap-2">
            <div class="flex gap-2">
                <p class="text-white"><?php echo $_SESSION['sellerName'] ?></P>
                <p class="text-slate-400 text-[15px]"><?php echo $_SESSION['sellerEmail'] ?></P>
            </div>
            <div><img src="../assets/icons/profile.png" class="w-[40px] md:w-[50px]"></div>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="w-full flex flex-row">
        <!-- SIDE BAR -->
        <nav class="bg-slate-800 h-[90%] p-0 fixed overflow-y-auto w-[60px] lg:w-[20%] mb-[90px] mt-[85px] flex flex-col items-center duration-300" id="sidenav">
            <div class="flex flex-col gap-5 mt-10 w-full items-center">

                <h4 class="text-slate-500 lg:hidden block">Menu</h4>
                <div class="w-[100%] lg:hidden flex justify-center items-center hover:bg-slate-900 py-3 rounded-lg cursor-pointer" id="bars">
                    <img src="../assets/icons/bars.png" class="w-[30px]" title="expand sidebar">
                </div>
                <div class="w-[100%] hidden justify-center items-center hover:bg-slate-900 py-3 rounded-lg cursor-pointer" id="close">
                    <img src="../assets/icons/cross.png" class="w-[30px]" title="close sidebar">
                </div>

                <h4 class="text-slate-500">Links</h4>
                <a href="seller_dash.php" class="flex flex-row justify-start items-center gap-5 w-[100%] p-5 rounded-lg hover:bg-slate-900 bg-slate-900">
                    <img src="../assets/icons/dashboard.png" class="w-[20px] lg:w-[30px] h-[20px] lg:h-[30px]">
                    <p class="text-white text-[15px] lg:block hidden navLink">Dashboard</p>
                </a>
                <a href="add_customer.php" class="flex flex-row justify-start items-center gap-5 w-[100%] p-5 rounded-lg hover:bg-slate-900">
                    <img src="../assets/icons/add.png" class="w-[20px] lg:w-[30px] h-[20px] lg:h-[30px]">
                    <p class="text-white text-[15px] lg:block hidden navLink">Register Customer</p>
                </a>
                <a href="scanQr.php" target="_blank" class="flex flex-row justify-start items-center gap-5 w-[100%] p-5 rounded-lg hover:bg-slate-900">
                    <img src="../assets/icons/delivery.png" class="w-[20px] lg:w-[30px] h-[20px] lg:h-[30px]">
                    <p class="text-white text-[15px] lg:block hidden navLink">Update Packages to Transit</p>
                </a>
            </div>

            <div class="flex flex-col gap-5 bottom-0 mb-3 py-3 absolute w-full items-center">
                <a href="seller_logout.php" class="flex flex-row justify-center items-center gap-5 w-[100%] p-5 rounded-lg hover:bg-slate-900">
                    <img src="../assets/icons/logout.png" class="w-[20px] lg:w-[20px] h-[20px] lg:h-[20px]">
                    <p class="text-white font-light text-[15px] lg:block hidden navLink">Sign out</p>
                </a>
            </div>
        </nav>


        <!-- get the number of buyers and packages -->
        <?php
            // get total number of buyers
            $buyerNo = "SELECT * FROM buyers";
            $buyerNoSql = mysqli_query($conn, $buyerNo);
            if($buyerNoSql){
                if(mysqli_num_rows($buyerNoSql) > 0){
                    $buyerTotal = mysqli_num_rows($buyerNoSql);
                }
                else{
                    $buyerTotal = 0;
                }
            }
            else{
                echo "error finding the number of buyers at the moment! " . mysqli_error($conn);
            }

            // get total number of orders
            $orderNo = "SELECT * FROM products";
            $orderNoSql = mysqli_query($conn, $orderNo);
            if($orderNoSql){
                if(mysqli_num_rows($orderNoSql) > 0){
                    $orderTotal = mysqli_num_rows($orderNoSql);
                }
                else{
                    $orderTotal = 0;
                }
            }
            else{
                echo "error finding the number of buyers at the moment! " . mysqli_error($conn);
            }
        
        ?>

        <!-- MAIN CONTENT -->
        <div class="flex flex-col w-[87%] lg:w-[80%] h-[100%] ml-[60px] lg:ml-[20%] mt-[85px] pb-10 duration-300">
            <div class="w-[90%] mx-auto mt-5"><h4 class="text-slate-400 text-[30px]">Admin Dashboard</h4></div>
            <div class="w-[95%] mx-auto mt-10 grid grid-cols-1 md:grid-cols-2 gap-5 p-10 py-10 rounded-lg overview">
                <div class="w-full p-3 bg-gradient-to-br from-slate-800 to-slate-500 rounded-lg">
                    <div class="flex items-center justify-between gap-3">
                        <h4 class="text-slate-200 text-md md:text-[25px] font-bold">Registered Customers</h4>
                        <img src="../assets/icons/customer.png" class="w-[50px] h-auto">
                    </div>
                    <h4 class="text-red-500 text-[55px] text-center font-bold"><?php echo $buyerTotal ?></h4>
                </div>

                <div class="w-full p-3 bg-gradient-to-br from-slate-800 to-slate-500 rounded-lg">
                    <div class="flex items-center justify-between gap-3">
                        <h4 class="text-slate-200 text-md md:text-[25px] font-bold">Ordered Packages</h4>
                        <img src="../assets/icons/delivery.png" class="w-[50px] h-auto">
                    </div>
                    <h4 class="text-green-500 text-[55px] text-center font-bold"><?php echo $orderTotal ?></h4>
                </div>
            </div>

            <!-- registered buyers table -->
            <div class="w-[95%] mx-auto mt-10 bg-slate-800 rounded-lg p-3 overflow-x-auto">
                <div class="flex flex-col md:flex-row gap-2 md:gap-5 w-[100%] h-auto">
                    <h4 class="font-bold text-red-500 text-xl md:text-[30px]">REGISTERED CUSTOMERS</h4>
                    <input type="text" class="w-[90%] md:w-[50%] h-auto px-3 outline-none border-none" id="buyer">
                </div>
                <table class="min-w-[800px] lg:w-[100%] md:relative overflow-x-auto mt-5" id="buyerTable">
                    <thead>
                        <tr className="flex justify-evenly mb-5">
                            <td class="text-slate-400 font-medium cols">Fisrt Name</td>
                            <td class="text-slate-400 font-medium cols">Last Name</td>
                            <td class="text-slate-400 font-medium cols">Mobile No.</td>
                            <td class="text-slate-400 font-medium cols">User Code</td>
                            <td class="text-slate-400 font-medium cols">Date Registered</td>
                            <td class="text-slate-400 font-medium cols">Actions</td>
                        </tr>
                    </thead>
               
                    <tbody>

                    <!-- get buyer's details -->
                    <?php
                            $buyerSql = "SELECT * FROM buyers ORDER BY date_time_reg DESC";
                            $buyerRst = mysqli_query($conn, $buyerSql);

                            if($buyerRst){
                                if(mysqli_num_rows($buyerRst) > 0){
                                    while($buyerDetails = mysqli_fetch_assoc($buyerRst)):
                                        $buyerID = $buyerDetails['buyer_id'];
                                        $buyerFname = stripslashes($buyerDetails['firstName']);
                                        $buyerLname = stripslashes($buyerDetails['lastName']);
                                        $buyerPhone = $buyerDetails['phoneNo'];
                                        $userCode = $buyerDetails['real_code'];
                                        $buyerDateReg = $buyerDetails['dateReg'];

                                        echo '<tr class="rows hover:bg-slate-900 mt-5">';
                                        echo '<td class="text-white font-light py-5 cols"><p>' . $buyerFname . '</p></td>';
                                        echo '<td class="text-white font-light py-5 cols"><p>' . $buyerLname . '</p></td>';
                                        echo '<td class="text-white font-light py-5 cols"><p>' . $buyerPhone . '</p></td>';
                                        echo '<td class="text-white font-light py-5 cols"><p>' . $userCode . '</p></td>';
                                        echo '<td class="text-white font-light py-5 cols"><p>' . $buyerDateReg . '</p></td>';
                                        echo '<td data-label="Actions">
                                                
                                                </td>';
                                        echo '</tr>';
                                    
                                    endwhile;
                                }
                                else{
                                    echo '<tr>
                                            <td colspan = "6" class="text-center text-white opacity-60 py-5">NO Buyers are Registered at the moment</td>
                                        </tr>';
                                }
                            }
                            else{
                                echo '<script>
                                    alert("error getting buyer\'s details");
                                </script>';
                            }
                        
                        ?>
                        <tr>
                            <td colspan = "6" class="text-center text-white opacity-60 py-5 hidden" id="itemNotFound">Searched item not found</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- ordered packages table -->
            <div class="w-[95%] mx-auto mt-10 bg-slate-800 rounded-lg p-3 overflow-x-auto">
                <div class="flex flex-col md:flex-row gap-2 md:gap-5 w-[100%] h-auto">
                    <h4 class="font-bold text-green-500 text-xl md:text-[30px]">ORDERED PACKAGES</h4>
                    <input type="text" class="w-[90%] md:w-[50%] h-auto px-3 outline-none border-none">
                </div>
                <table class="min-w-[800px] lg:w-[100%] md:relative overflow-x-auto mt-5">
                    <thead>
                        <tr className="flex justify-evenly">
                            <td class="text-slate-400 font-medium cols">Package Name</td>
                            <td class="text-slate-400 font-medium cols">Package Color</td>
                            <td class="text-slate-400 font-medium cols">Date Packed</td>
                            <td class="text-slate-400 font-medium cols">From</td>
                            <td class="text-slate-400 font-medium cols">To</td>
                            <td class="text-slate-400 font-medium cols">Reciever</td>
                            <td class="text-slate-400 font-medium cols">Transport Date</td>
                            <td class="text-slate-400 font-medium cols">Package Code</td>
                            <td class="text-slate-400 font-medium cols">Status</td>
                            <td class="text-slate-400 font-medium cols">Actions</td>
                        </tr>
                    </thead>
               
                    <tbody>

                    <!-- get packages' details -->
                    <?php
                                    $packageSql = "SELECT * FROM products ORDER BY p_date_time DESC";
                                    $packageRst = mysqli_query($conn, $packageSql);
        
                                    if($packageRst){
                                        if(mysqli_num_rows($packageRst) > 0){
                                            while($packageDetails = mysqli_fetch_assoc($packageRst)):
                                                $packagename = stripslashes($packageDetails['p_name']);
                                                $packageColor = stripslashes($packageDetails['p_color']);
                                                $packageDate = $packageDetails['p_date'];
                                                $packageFrom = $packageDetails['p_from'];
                                                $packageTo = $packageDetails['p_destination'];
                                                $packageOwner = $packageDetails['p_owner'];
                                                $packageTransDate = $packageDetails['p_transDate'];
                                                $packageCode = $packageDetails['p_code'];
                                                $packageStaus = $packageDetails['p_status'];

                                                // get owner's name
                                                $ownerSql = "SELECT firstName, lastName FROM buyers WHERE phoneNo = $packageOwner";
                                                $ownerRst = mysqli_query($conn, $ownerSql);
                                                if($ownerRst){
                                                    $ownerDetails = mysqli_fetch_assoc($ownerRst);
                                                    $ownerFname = stripslashes($ownerDetails['firstName']);
                                                    $ownerLname = stripslashes($ownerDetails['lastName']);
                                                    $ownerName = $ownerFname . ' ' . $ownerLname;
                                                }
                                                else{
                                                    $ownerName = "error getting the reciever's name " . mysqli_error($conn);
                                                }

        
                                                echo '<tr class="rows hover:bg-slate-900">';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packagename . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packageColor . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packageDate . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packageFrom . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packageTo . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $ownerName . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . 
                                                    $packageTransDate . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p>' . $packageCode . '</p></td>';
                                                echo '<td class="text-white font-light py-2 cols"><p class="pstatus rounded-md p-[5px]">' .
                                                            $packageStaus . '</p></td>';
                                                echo '<td data-label="Actions"></td>';
                                                echo '</tr>';
                                            
                                            endwhile;
                                        }
                                        else{
                                            echo '<tr>
                                                <td colspan = "8" class="text-center text-white opacity-60 py-5">No ordered Packages</td>
                                            </tr>';
                                        }
                                    }
                                    else{
                                        echo '<script>
                                            alert("error getting buyer\'s details");
                                        </script>';
                                    }
                                
                                ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>


            <!-- ADD-PACKAGE ALERT -->
            <!-- <div class="row m-0 p-0" id="addPackageAlert">
                <div class="col-12 m-0 p-0">
                    <form action="updateUserPackage.php" method="post" class="addPackageForm">
                        <h5 style="color: white;">ADD USER'S PACKAGE</h5>
                        <img src="assets/icons/xmark-white.png" title="close box" width="25px" id="closeAddPackage"><br>
                        <div class="buyerDetails">
                            <div>
                                <label for="codeInput">Buyer's Names:</label>
                                <input type="text" name="buyerNames" disabled  class="form-control" id="buyerNames">
                            </div>
                            <div>
                                <label for="buyerPhone">Buyer's Phone No:</label>
                                <input type="text" name="buyerPhone"  class="form-control" id="buyerPhone">
                            </div>
                        </div><br>
                        <div class="firstName formdiv">
                            <label>Product Name</label><br>
                            <input type="text" name="pname" class="form-control" id="pname" required>
                            <i></i>
                        </div><br>
                        <div class="lastName formdiv">
                            <label>Product Color</label><br>
                            <input type="text" name="pcolor" class="form-control" id="pcolor" required>
                            <i></i>
                        </div><br>
                        <div class="lastName formdiv">
                            <label>Number of Products</label><br>
                            <input type="number" name="pnum" min="1" class="form-control" id="pnum" required>
                            <i></i>
                        </div><br>
                        <div class="lastName formdiv">
                            <label>From</label><br>
                            <input class="form-control" list="regions" name="from_region" required>
                            <i></i>
                            <datalist id="regions">
                                <option value="DAR ES SALAAM">
                                <option value="MWANZA">
                                <option value="ARUSHA">
                                <option value="DODOMA">
                            </datalist>
                        </div><br>
                        <div class="lastName formdiv">
                            <label>Destination</label><br>
                            <input class="form-control" list="regions" name="to_region" required>
                            <i></i>
                            <datalist id="regions">
                                <option value="DAR ES SALAAM">
                                <option value="MWANZA">
                                <option value="ARUSHA">
                                <option value="DODOMA">
                            </datalist>
                        </div><br>
                        <div class="packageStatus formdiv">
                            <label>Package Status</label>
                            <div class="radioItem">
                                <input type="radio" checked name="radio" value="Packed" id="packed">
                                <label for="packed">PACKED</label>
                            </div>
                            <div class="radioItem">
                                <input type="radio" name="radio" value="In transit" id="otw">
                                <label for="otw">ON THE WAY</label>
                            </div>
                            <div class="radioItem">
                                <input type="radio" name="radio" value="Arrived" id="delivered">
                                <label for="delivered">ARRIVED</label>
                            </div>
                        </div><br>
                        <div class="mt-3 transportDate formdiv">
                            <label>Date of Transportation</label>
                            <input type="date" class="form-control" name="transDate" id="transDate" required>
                            <i></i>
                        </div><br>
                        <div class="mt-3 submit formdiv">
                            <input type="submit" name="submiter" id="submiter" value="ADD PACKAGE" class="form-control">
                        </div>
                    </form>
                </div>
            </div> -->

            <!-- DELETE CUSTOMER ALERT -->
            <!-- <div class="row m-0 p-0" id="deleteCustomerAlert">
                <div class="col-12 m-0 p-0">
                    <form action="deleteCustomer.php" method="post" class="deleteCustomerForm">
                        <div class="delHeading">
                            <h5 style="color: red;">DELETE CUSTOMER</h5>
                            <img src="assets/icons/delete.png" width="35px">
                        </div>
                        <img src="assets/icons/xmark-white.png" title="close box" width="25px" id="closeDeleteUser"><br>
                        <div class="buyerDetails">
                            <div>
                                <label for="codeInput">Buyer's Names:</label>
                                <input type="text" name="buyerNames" disabled  class="form-control" id="delbuyerNames">
                            </div><br>
                            <div>
                                <label for="buyerPhone">Buyer's Phone No:</label>
                                <input type="text" name="buyerPhone"  class="form-control" id="delbuyerPhone">
                            </div>
                        </div><br>
                        <div class="mt-3 submit formdiv">
                            <input type="submit" name="submiter" id="submiter" value="DELETE CUSTOMER" class="form-control">
                        </div>
                    </form>
                </div>
            </div> -->


            <!-- UPDATE PACKAGE STATUS ALERT -->
            <!-- <div class="row m-0 p-0" id="statusAlert">
                <div class="col-12 m-0 p-0">
                    <form action="updatePackage.php" method="post" class="statusForm">
                        <h5 style="color: white;">UPDATE PACKAGE TRAVEL STATUS</h5>
                        <img src="assets/icons/xmark-white.png" title="close box" width="25px" id="closeAlert"><br>
                        <div>
                            <label for="pCode">Package Code:</label>
                            <input type="text" name="pcode"  class="form-control" id="codeInput"><br>
                        </div>
                        <label>Update Package Status To:</label>
                        <div class="radioItem">
                            <input type="radio"  name="radio" value="Packed" id="packedUpdated" required>
                            <label for="packedUpdated">PACKED</label>
                        </div>
                        <div class="radioItem">
                            <input type="radio" name="radio" value="In transit" id="otwUpdated" required>
                            <label for="otwUpdated">ON THE WAY</label>
                        </div>
                        <div class="radioItem">
                            <input type="radio" name="radio" value="Arrived" id="deliveredUpdated" required>
                            <label for="deliveredUpdated">ARRIVED</label>
                        </div><br>

                        <input type="submit" name="updater" class="form-control" value="UPDATE PACKAGE STATUS"><br>
                    </form>
                </div>
            </div> -->


            <!-- DELETE PACKAGE ALERT -->
            <!-- <div class="row m-0 p-0" id="deleteAlert">
                <div class="col-12 m-0 p-0">
                    <form action="deletePackage.php" method="post">
                        <div class="delHeading">
                            <h5 style="color: red;">DELETE PACKAGE</h5>
                            <img src="assets/icons/delete.png" width="35px" id="closeAlert">
                        </div>
                        <div>
                            <label for="pCode">Package Code:</label>
                            <input type="text" name="pcode" class="form-control" id="codeInputDel"><br>
                        </div>
                        <div>
                            <label for="pCode">Package Name:</label>
                            <input type="text" disabled class="form-control" id="nameInputDel"><br>
                        </div>
                        <div class="choise">
                            <input type="submit" name="deleter" class="form-control" value="DELETE">
                            <input type="button" class="form-control" value="CANCEL" id="closeDelAlert">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div> -->

    <script>

        // // CLOSING CUSTOMER ALERTS
        // var closeUserUpdate = document.getElementById('closeAddPackage');
        // closeUserUpdate.addEventListener('click', function(){
        //     document.getElementById('addPackageAlert').style.display="none";
        // });
        // var closeDeleteUser =  document.getElementById('closeDeleteUser');
        // closeDeleteUser.addEventListener('click', function(){
        //     document.getElementById('deleteCustomerAlert').style.display = "none";
        // });

        // // OPENING USER ALERTS
        // var addPackages = document.querySelectorAll('.addPackage');
        // addPackages.forEach(function(addPackage){
        //     addPackage.addEventListener('click', function(){
        //         var row = this.closest('tr');
        //         var fname = row.cells[1].textContent;
        //         var lname = row.cells[2].textContent;
        //         var phone = row.cells[3].textContent;

        //         document.getElementById('buyerPhone').addEventListener('focus', function(){
        //             this.disabled = true;
        //         })
        //         document.getElementById('buyerPhone').addEventListener('blur', function(){
        //             this.disabled = false;
        //         })
        //         document.getElementById('buyerNames').value = fname + ' ' + lname;
        //         document.getElementById('buyerPhone').value = phone;
        //         document.getElementById('addPackageAlert').style.display="block";
        //     });
        // });

        // var deleteCustomers = document.querySelectorAll('.deleteCustomer');
        // deleteCustomers.forEach(function(deleteCustomer){
        //     deleteCustomer.addEventListener('click', function(){
        //         var row = this.closest('tr');
        //         var fname = row.cells[1].textContent;
        //         var lname = row.cells[2].textContent;
        //         var phoneNo = row.cells[3].textContent;

        //         document.getElementById('delbuyerNames').value = fname + ' ' + lname;
        //         document.getElementById('delbuyerPhone').value = phoneNo;
        //         document.getElementById('delbuyerPhone').addEventListener('focus', function(){
        //             this.disabled = true;
        //         });
        //         document.getElementById('delbuyerPhone').addEventListener('blur', function(){
        //             this.disabled = false;
        //         });
        //         document.getElementById('deleteCustomerAlert').style.display="block";
        //     });
        // });

        // // CLOSING PACKAGE ALERT BOXES
        // var closestatusAlert = document.getElementById('closeAlert');
        // closestatusAlert.addEventListener('click', function(){
        //     document.getElementById('statusAlert').style.display = "none";
        // })
        // var closedeleteAlert = document.getElementById('closeDelAlert');
        // closedeleteAlert.addEventListener('click', function(){
        //     document.getElementById('deleteAlert').style.display = "none";
        // })

        // // OPENING PACKAGE ALERTS
        // var statusLinks = document.querySelectorAll('.statusLink');

        // statusLinks.forEach(function(statusLink){
        //     statusLink.addEventListener('click', function(){
        //         var row = this.closest('tr');
        //         var code = row.cells[7].textContent;

        //         document.getElementById('codeInput').addEventListener('focus', function(){
        //             this.disabled = true;
        //         });
        //         document.getElementById('codeInput').addEventListener('blur', function(){
        //             this.disabled = false;
        //         });
        //         document.getElementById('codeInput').value = code;
        //         document.getElementById('statusAlert').style.display = "block";
        //     });
        // });

        // var delLinks = document.querySelectorAll('.delLink');

        // delLinks.forEach(function(delLink){
        //     delLink.addEventListener('click', function(){
        //         var row = this.closest('tr');
        //         var name = row.cells[0].textContent;
        //         var code = row.cells[7].textContent;

        //         document.getElementById('codeInputDel').addEventListener('focus', function(){
        //             this.disabled = true;
        //         });
        //         document.getElementById('codeInputDel').addEventListener('blur', function(){
        //             this.disabled = false;
        //         });
        //         document.getElementById('codeInputDel').value = code;
        //         document.getElementById('nameInputDel').value = name;
        //         document.getElementById('deleteAlert').style.display = "block";
        //     });
        // });

        // display different colors on different status
        var pstatuses = document.querySelectorAll('.pstatus');

        pstatuses.forEach(function(pstatus){
            pstatusVal = pstatus.textContent;
            if(pstatusVal == 'Packed'){
                pstatus.style.backgroundColor = "rgba(4, 69, 209, 0.836)";
            }
            else if(pstatusVal == 'In transit'){
                // pstatus.style.backgroundColor = "rgb(179, 152, 1)";
                pstatus.classList.add('bg-yellow-700');
            }
            else if(pstatusVal == 'Arrived'){
                pstatus.style.backgroundColor = "rgba(0, 128, 0, 0.849)";
            }
        });
        

        // script to handel customer search
        document.getElementById('buyer').addEventListener('input', function(){
            var searchedBuyer = this.value.toLowerCase();
            var buyerRows = document.querySelectorAll('#buyerTable tbody tr');
            var foundItem = false;

            buyerRows.forEach(function(row){
                var rowData = row.textContent.toLowerCase();
                if(rowData.includes(searchedBuyer)){
                    row.style.display = "table-row";
                    foundItem = true;
                }
                else{
                    row.style.display = "none";
                    foundItem = false;
                }
            });

            if(foundItem){
                document.getElementById('itemNotFound').style.display = "none";
            }
            else{
                // document.getElementById('itemNotFound').style.display = "table-row";
                var itemNotFound = document.getElementById('itemNotFound');
                itemNotFound.classList.replace('hidden', 'table-row');
            }
        });


        // // script to handle package search
        // document.getElementById('package').addEventListener('input', function(){
        //     var searchedPackage = this.value.toLowerCase();
        //     var packageRows = document.querySelectorAll('#packageTable tbody tr');
        //     var foundItem = false;

        //     packageRows.forEach(function(row){
        //         var rowData = row.textContent.toLowerCase();
        //         if(rowData.includes(searchedPackage)){
        //             row.style.display = "table-row";
        //             foundItem = true;
        //         }
        //         else{
        //             row.style.display = "none";
        //         }
        //     });

        //     if(foundItem){
        //         document.getElementById('packageitemNotFound').style.display = "none";
        //     }
        //     else{
        //         document.getElementById('packageitemNotFound').style.display = "table-row";
        //     }
        // });

    </script>

    <!-- external js -->
    <script src="../js/script.js"></script>
</body>
</html>