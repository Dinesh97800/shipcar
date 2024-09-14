<table id="example" class="table table-bordered">
<style>
    .status-btn {
        display: inline-block;
        padding: 5px 10px;
        border: 2px dashed green; /* Dashed border */
        border-radius: 5px; /* Rounded corners */
        color: #000; /* Text color */
        text-align: center;
        cursor: default; /* Cursor won't change on hover */
        font-size: 14px; /* Adjust text size */
        background-color: transparent; /* Optional: change background color */
    }
     /* Example: Customize colors for different statuses */
     .pending {
        border-color: orange;
        color: orange;
    }

    .completed {
        border-color: green;
        color: green;
    }

    .failed {
        border-color: red;
        color: red;
    }
</style>

    <thead>
        <tr>
            <?php
            foreach ($tableColumn as $column) {
                ?>
            <th> <?php echo $column ?> </th>
            <?php } ?>

        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($countries)) {
            $counter = 1;
            foreach ($countries as $country) {
                ?>
        <tr>
            <td> <?php echo $counter++; ?> </td>
            <td> <?php echo htmlspecialchars($country['name']); ?> </td>
            <td><?php echo date('d/m/Y', strtotime($country['created_at'])); ?></td>

            <td>
                <div class="d-flex">
                    <a type="button" class="btn btn-dark btn-rounded btn-fw me-2 edit-country-btn"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        data-country-id="<?php echo $country['id']; ?>"
                        data-country-name="<?php echo htmlspecialchars($country['name']); ?>">Edit</a>

                    <!-- <a type="button" class="btn btn-dark btn-rounded btn-fw me-2">Edit</a> -->
                    <a href="<?php echo $APP_URL ?>Api/admin/countries.php?delete=<?php echo $country['id']; ?>" 
   class="btn btn-danger btn-rounded btn-fw"
   onclick="return confirm('Are you sure you want to delete this country?');">Delete</a>
                </div>
            </td>
        </tr>
        <?php
            }
        }

        if (isset($enquiries)) {
            $counter = 1;
            foreach ($enquiries as $enquiry) {

                ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td class="enquiryname"><?php echo htmlspecialchars($enquiry['email']); ?></td>
            <td class="enquiryname"><?php echo htmlspecialchars($enquiry['make'].'/'.$enquiry['model']); ?></td>
            <td><?php echo htmlspecialchars($enquiry['destination']); ?></td>
            <td><?php echo htmlspecialchars($enquiry['length']); ?></td>
            <td><?php echo htmlspecialchars($enquiry['width']); ?></td>
            <td><?php echo htmlspecialchars($enquiry['height']); ?></td>
            <td>$<?php echo htmlspecialchars($enquiry['cost']); ?></td>
            <td>
    <span class="status-btn"><?php echo htmlspecialchars($enquiry['status']); ?></span>
</td>
            <td>
                <div class="d-flex">
                    <a type="button" class="btn btn-danger btn-rounded btn-fw">Resend</a>
                </div>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>