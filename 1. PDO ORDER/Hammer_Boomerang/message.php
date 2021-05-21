<?php
                                        if(isset($_GET['status'])){
                                            $color = $_GET['status'];
                                            $message = $_GET['message'];
                                        ?>
                                            <div class="alert alert-<?= $color;?>">
                                            
                                                <?= $message; ?>
                                            </div>
                                        <?php
                                        }

                                        ?>