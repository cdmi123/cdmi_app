 <?php foreach ($certi_data as $Data) { ?>
                <tr>
                  <td><?php echo $Data['id']; ?></td>
                  <td><?php echo $Data['certificate_no']; ?></td>
                  <td><?php echo $Data['student_name']; ?></td>
                  <td><?php echo $Data['certificate_name']; ?></td>
                  <td><?php echo $Data['amount']; ?></td>
                  <td><?php echo $Data['payment_detail']; ?></td>
                  <td><?php echo $Data['ref_by']; ?></td>
                  <td><?php echo $Data['from_date']; ?></td>
                  <td><?php echo $Data['to_date']; ?></td>
                  <td><?php echo $Data['created_date']; ?></td>
                </tr>
<?php } ?>