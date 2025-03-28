<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); 

$setting=fetch_array("SELECT * FROM website_header LIMIT 1");if(!$setting)die();
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>GMARKETVN | Buy Korean domestic products at original prices from the manufacturer</title>

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
        <?php include("../layout/sidebar.php")?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="h3">Website Header</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Header Setting</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">Header Logo</label>
                                            <div class="col-md-8">
                                                <div class=" input-group " data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                    </div>
                                                    <div class="form-control file-amount">Choose File</div>
                                                    <input type="hidden" name="types[]" value="header_logo">
                                                    <input type="hidden" name="header_logo" class="selected-files" value="<?=$setting['header_logo']?>">
                                                </div>
                                                <div class="file-preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">Show Language Switcher?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_language_switcher">
                                                    <input type="checkbox" name="show_language_switcher" <?=$setting['show_language_switcher']?"checked":""?>>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">Show Currency Switcher?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_currency_switcher"  >
                                                    <input type="checkbox" name="show_currency_switcher"  <?=$setting['show_currency_switcher']?"checked":""?>  >
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">Enable stikcy header?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="header_stikcy">
                                                    <input type="checkbox" name="header_stikcy" <?=$setting['enable_stikcy_header']?"checked":""?> >
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="border-top pt-3">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">Topbar Banner</label>
                                                <div class="col-md-8">
                                                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="types[]" value="topbar_banner">
                                                        <input type="hidden" name="topbar_banner" class="selected-files" value="<?=$setting['topbar_banner']?>">
                                                    </div>
                                                    <div class="file-preview"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">Topbar Banner Link</label>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="topbar_banner_link">
                                                        <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="topbar_banner_link" value="<?=$setting['topbar_banner_link']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top pt-3">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">LINK CSKH</label>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="helpline_number">
                                                        <input type="text" class="form-control" placeholder="LINK livechat" name="helpline_number" value="<?=$setting['cskh']?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="form-group row">
							<label class="col-md-3 col-from-label">TELEGRAM</label>
							<div class="col-md-8">
								<div class="form-group">
									<input type="hidden" name="types[]" value="telegram">
									<input type="text" class="form-control" placeholder="TELEGRAM" name="telegram" value="@cskhnhauyen">
								</div>
							</div>
						</div>-->
                                        </div>
                                        <div class="border-top pt-3">
                                            <label class="">Header Nav Menu</label>
                                            <div class="header-nav-menu">
                                                <input type="hidden" name="types[]" value="header_menu_labels">
                                                <input type="hidden" name="types[]" value="header_menu_links">
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Lotte">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.lotte.co.kr/global/en/main.do#firstPage">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="The Face Shop">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.thefaceshop.com/mall/index.jsp">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Ohui">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://ohui.com/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Samsung">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.samsung.com/ae/smartphones/galaxy-s24/buy/?cid=ae_pd_ppc_google_f1h24_sustain_f1h24_stads_multi_bap_ae_en_na_wh_lo_cross_mx_performance-max_multi_kew__conv&amp;utm_campaign=f1h24&amp;utm_medium=pd_ppc&amp;utm_source=google&amp;utm_content=ae_f1h24_sustain_f1h24_stads_multi_bap_ae_en_na_wh_lo_cross_mx_performance-max_multi_kew__conv&amp;gad_source=1&amp;gclid=Cj0KCQjw3ZayBhDRARIsAPWzx8pvR2F2IPgx2Qzs9QBADNyuFeSSoCQOIEPqAIzCs1-jnabv6i2rV5UaArC1EALw_wcB&amp;gclsrc=aw.ds">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="LG">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.lge.co.kr/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Cuckoo">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.cuckoo.co.kr/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Kye">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://kye-official.com/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Harriot">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://harriotwatches.com/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Dogfight">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.altivo.com/collections/dogfight">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Toytron">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://koreantoyshop.com/toytron/">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Toys &#039;R&#039; Us">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://www.lotteon.com/p/display/main/toysrus?mall_no=9&amp;ch_no=100325&amp;ch_dtl_no=1000840&amp;utm_source=google&amp;utm_medium=cpc&amp;utm_term=%EC%9E%90%EC%82%AC%EB%B8%8C%EB%9E%9C%EB%93%9C&amp;utm_campaign=paid_google_cpc_pc&amp;gad_source=1&amp;gclid=Cj0KCQjw3ZayBhDRARIsAPWzx8pezexdw0n1Il9JIHUG0ISMVnWjkiRvSV_o6SVC8wyDIPvtlYTA2XgaAnmlEALw_wcB">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]" value="Ruche">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]" value="https://ruche.vn/minervamade-in-korea">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-soft-secondary btn-sm"
                                                data-toggle="add-more"
                                                data-content='<div class="row gutters-5">
								<div class="col-4">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Label" name="header_menu_labels[]">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Link with http:// Or https://" name="header_menu_links[]">
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
                                                data-target=".header-nav-menu">
                                                Add New
                                            </button>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; GMARKETVN v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('https://tmdtquocte.com/language', {
                        _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }

        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
                    }
                } else {
                    $("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">Nothing found</span></li>`);
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>

</body>

</html>