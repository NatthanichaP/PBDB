<div class="modal fade" id="md_<?php echo $row['classroom_id']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">รายละเอียดห้อง <?php echo $row['classroom_number']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>ชื่อห้อง: <?php echo $row['classroom_name']; ?></p>
                                                        <p>เลขห้อง: <?php echo $row['classroom_number']; ?></p>
                                                        <p>ชื่อตึก: <?php echo $row['building_name']; ?></p>
                                                        <p>ชื่อผู้จอง: <?php echo $row['classroom_fname']; ?></p>
                                                        <p>วันที่และเวลาเริ่ม: <?php echo $row['reserve_strdate']; ?></p>
                                                        <p>วันที่และเวลาสิ้นสุด: <?php echo $row['reserve_enddate']; ?></p>
                                                        <p>จำนวนที่นั่ง: <?php echo $row['classroom_number_of_seats']; ?></p>
                                                        <p>ชั้น: <?php echo $row['classroom_studied']; ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <td>
                                                <a href="#" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#md_<?php echo $row['classroom_id']; ?>">รายละเอียด</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="md_<?php echo $row['classroom_id']; ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">รายละเอียดห้อง <?php echo $row['classroom_number']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>ชื่อห้อง: <?php echo $row['classroom_name']; ?></p>
                                                        <p>เลขห้อง: <?php echo $row['classroom_number']; ?></p>
                                                        <p>ชื่อตึก: <?php echo $row['building_name']; ?></p>
                                                        <p>ชื่อผู้จอง: <?php echo $row['classroom_fname']; ?></p>
                                                        <p>วันที่และเวลาเริ่ม: <?php echo $row['reserve_strdate']; ?></p>
                                                        <p>วันที่และเวลาสิ้นสุด: <?php echo $row['reserve_enddate']; ?></p>
                                                        <p>จำนวนที่นั่ง: <?php echo $row['classroom_number_of_seats']; ?></p>
                                                        <p>ชั้น: <?php echo $row['classroom_studied']; ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>