<?php 
        class Alert{
            public function display($message, $type){
                echo '<div class="alert alert-'. $type .'" role="alert" style="text-align:center;font-size:30px;font-weight: bolder;">';
                echo ''.$message.'';
                echo '</div>';
            }

            public function swal_alert($message, $type){
                echo "<script>
                $(document).ready(function(){
                Swal.fire({
                    icon : '$type',
                    title : '$message',
                    timerProgressbar: true,
                    timer : 1500,
                    showButtonConfirm : true

                });
                });
                </script>";
            }

            public function swal_welcome($message, $type){
                echo "<script>
               Swal.fire({
                       icon: '$type',
                        title: '$message',
                        width: 600,
                        padding: '3em',
                        color: 'white',
                        background: 'center url(https://media4.giphy.com/media/DyQrKMpqkAhNHZ1iWe/giphy.webp?cid=790b7611ifgvb2u7gwbohl36yxtnn9ttqnmedue8p0v5m5gc&ep=v1_gifs_search&rid=giphy.webp&ct=g)',
                        backdrop: `
                          rgba(0,144,255,0.4)
                          url('https://sweetalert2.github.io/images/nyan-cat.gif')
                          left 
                          no-repeat
                        `
                      });
                </script>";
            }
        }


?>