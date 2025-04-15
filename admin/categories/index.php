<?php include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>Takashimaya | Category Management</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">
    <!-- 引入 layui.css -->
    <link rel="stylesheet" href="/public/layui/css/layui.css">

    <style>
        body {
            font-size: 12px;
        }

        .category-banner {
            height: 60px;
            width: 120px;
            object-fit: cover;
        }

        .category-icon {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose File',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php") ?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <?php
                    // Handle status messages
                    if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                        <div class="alert alert-success"><?= $_GET['message'] ?? 'Operation completed successfully!' ?></div>
                    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                        <div class="alert alert-danger"><?= $_GET['message'] ?? 'An error occurred!' ?></div>
                    <?php endif; ?>

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?= tran("All Categories") ?></h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="/admin/categories/create.php" class="btn btn-primary">
                                    <span><i class="las la-plus"></i> <?= tran("Add New Category") ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-block d-md-flex">
                            <h5 class="mb-0 h6"><?= tran("Categories") ?></h5>
                            <form id="sort_categories" action="" method="GET" class="ml-auto">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Type name & Enter"
                                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><?= tran("Search") ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th><?= tran("Name") ?></th>
                                        <th width="15%"><?= tran("Banner") ?></th>
                                        <th width="15%"><?= tran("Path") ?></th>
                                        <th width="15%"><?= tran("Created") ?></th>
                                        <th width="15%" class="text-right"><?= tran("Options") ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Build search query
                                    $search_condition = "";
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                                        $search_condition = "WHERE name LIKE '%$search%'";
                                    }

                                    // Pagination setup
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $limit = 10;
                                    $offset = ($page - 1) * $limit;

                                    // Get total number of categories for pagination
                                    $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM categories $search_condition");
                                    $total_categories = mysqli_fetch_assoc($total_query)['total'];
                                    $total_pages = ceil($total_categories / $limit);

                                    // Get categories for current page
                                    $sql = mysqli_query($conn, "SELECT * FROM categories $search_condition ORDER BY id DESC LIMIT $limit OFFSET $offset");
                                    $i = $offset;

                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= htmlspecialchars($row['name']) ?></td>
                                            <td>
                                                <img src="/public/uploads/all/<?= htmlspecialchars($row['img']) ?>" alt="Banner" class="category-banner">
                                            </td>
                                            <td><?= htmlspecialchars($row['path']) ?></td>
                                            <td><?= date('d M Y', strtotime($row['create_date'])) ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/categories/edit.php?id=<?= $row['id'] ?>" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/categories/delete.php?id=<?= $row['id'] ?>" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($i == $offset): ?>
                                        <tr>
                                            <td colspan="6" class="text-center"><?= tran("No categories found") ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="aiz-pagination mt-3">
                                <?php if ($total_pages > 1): ?>
                                    <nav>
                                        <ul class="pagination">
                                            <!-- Previous page link -->
                                            <?php if ($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page - 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&laquo;</span>
                                                </li>
                                            <?php endif; ?>

                                            <!-- Page numbers -->
                                            <?php
                                            $start_page = max(1, $page - 2);
                                            $end_page = min($total_pages, $page + 2);

                                            for ($i = $start_page; $i <= $end_page; $i++):
                                            ?>
                                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">
                                                        <?= $i ?>
                                                    </a>
                                                </li>
                                            <?php endfor; ?>

                                            <!-- Next page link -->
                                            <?php if ($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?= $page + 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&raquo;</span>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Takashimaya v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?= tran("Delete Confirmation") ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?= tran("Are you sure to delete this category?") ?></p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal"><?= tran("Cancel") ?></button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2"><?= tran("Delete") ?></a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script type="text/javascript">
        // Delete confirmation modal
        $(document).on('click', '.confirm-delete', function(e) {
            e.preventDefault();
            $('#delete-modal').modal('show');
            document.getElementById('delete-link').setAttribute('href', $(this).data('href'));
        });

        // Submit search form when Enter is pressed
        $('#search').keypress(function(e) {
            if (e.which == 13) {
                $('#sort_categories').submit();
            }
        });
    </script>
</body>

</html>