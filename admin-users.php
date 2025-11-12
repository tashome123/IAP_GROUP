<?php
require "ClassAutoLoad.php";


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_role'])) {
    $user_id_to_change = $_POST['user_id'];
    $new_role = $_POST['new_role'];


    if (isset($_SESSION['user_id']) && $user_id_to_change == $_SESSION['user_id'] && $new_role !== 'admin') {
        $_SESSION['msg'] = 'You cannot demote your own admin account.';
        $_SESSION['msg_type'] = 'danger';
    } else {

        $ObjDB->query("UPDATE users SET role = ? WHERE id = ?", [$new_role, $user_id_to_change]);

        $_SESSION['msg'] = 'User role updated successfully.';
        $_SESSION['msg_type'] = 'success';
    }
    header("Location: admin-users.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id'];


    if (isset($_SESSION['user_id']) && $user_id_to_delete == $_SESSION['user_id']) {
        $_SESSION['msg'] = 'You cannot delete your own admin account.';
        $_SESSION['msg_type'] = 'danger';
    } else {

        $ObjDB->query("DELETE FROM users WHERE id = ?", [$user_id_to_delete]);

        $_SESSION['msg'] = 'User deleted successfully.';
        $_SESSION['msg_type'] = 'success';
    }
    header("Location: admin-users.php");
    exit();
}



$all_users = $ObjDB->fetchAll("SELECT id, fullname, email, role FROM users ORDER BY id ASC");


$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->admin_users_list($conf, $all_users);

?>

<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

<script>
    function exportToExcel() {

        TableToExcel.convert(document.getElementById("user-table"), {
            name: "StrathEventique_Users.xlsx",
            sheet: {
                name: "Users"
            }
        });
    }

    function exportToPDF() {

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();


        doc.autoTable({
            html: '#user-table',

            columns: [
                { header: 'ID', dataKey: 'ID' },
                { header: 'Full Name', dataKey: 'Full Name' },
                { header: 'Email', dataKey: 'Email' },
                { header: 'Role', dataKey: 'Role' },
            ],

            columnStyles: {
                4: { cellWidth: 0, minCellWidth: 0, cellOpacity: 0 },
                5: { cellWidth: 0, minCellWidth: 0, cellOpacity: 0 }
            },
            didParseCell: function (data) {

                if (data.column.index === 4 || data.column.index === 5) {
                    data.cell.text = '';
                }
            }
        });


        doc.save('StrathEventique_Users.pdf');
    }
</script>

<?php

$ObjLayout->footer($conf);

?>