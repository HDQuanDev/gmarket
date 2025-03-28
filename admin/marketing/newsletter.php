<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>
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
            nothing_selected: '<?=tran("Nothing selected")?>',

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

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Send Newsletter")?></h5>
                                </div>

                                <div class="card-body">
                                    <form class="form-horizontal" action="/admin/newsletter/send" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-from-label" for="name"><?=tran("Emails")?> (<?=tran("Users")?>)</label>
                                            <div class="col-sm-10">
                                                <select class="form-control aiz-selectpicker" name="user_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                                    <option value="admin2@admin.com"><template class="__cf_email__" data-cfemail="09686d6460673b49686d646067276a6664">[email&#160;protected]</template></option>
                                                    <option value="gmarketadmin@gmail.com"><template class="__cf_email__" data-cfemail="25424844574e40514441484c4b654248444c490b464a48">[email&#160;protected]</template></option>
                                                    <option value=""></option>
                                                    <option value="yennhii@gmail.com"><template class="__cf_email__" data-cfemail="453c202b2b2d2c2c052228242c296b262a28">[email&#160;protected]</template></option>
                                                    <option value="admin@gmail.com"><template class="__cf_email__" data-cfemail="dbbabfb6b2b59bbcb6bab2b7f5b8b4b6">[email&#160;protected]</template></option>
                                                    <option value="raccingboy.com">raccingboy.com</option>
                                                    <option value="johnsatham@gmail.com"><template class="__cf_email__" data-cfemail="d1bbbeb9bfa2b0a5b9b0bc91b6bcb0b8bdffb2bebc">[email&#160;protected]</template></option>
                                                    <option value="ahajohn@gmail.com"><template class="__cf_email__" data-cfemail="9cfdf4fdf6f3f4f2dcfbf1fdf5f0b2fff3f1">[email&#160;protected]</template></option>
                                                    <option value="Anhhoang0000@gmail.com"><template class="__cf_email__" data-cfemail="fdbc939595929c939acdcdcdcdbd9a909c9491d39e9290">[email&#160;protected]</template></option>
                                                    <option value="yennhii23@gmail.com"><template class="__cf_email__" data-cfemail="7108141f1f191818434231161c10181d5f121e1c">[email&#160;protected]</template></option>
                                                    <option value="kkaka@gmail.com"><template class="__cf_email__" data-cfemail="610a0a000a0021060c00080d4f020e0c">[email&#160;protected]</template></option>
                                                    <option value="Anh@gmail.com"><template class="__cf_email__" data-cfemail="43022d2b03242e222a2f6d202c2e">[email&#160;protected]</template></option>
                                                    <option value="Felicia@gmail.com"><template class="__cf_email__" data-cfemail="6c2a0900050f050d2c0b010d0500420f0301">[email&#160;protected]</template></option>
                                                    <option value="Yaretz@gmail.com"><template class="__cf_email__" data-cfemail="edb48c9f889997ad8a808c8481c38e8280">[email&#160;protected]</template></option>
                                                    <option value="dn3481419@gmail.com"><template class="__cf_email__" data-cfemail="99fdf7aaada1a8ada8a0d9fef4f8f0f5b7faf6f4">[email&#160;protected]</template></option>
                                                    <option value="hocuong1988@gmail.com"><template class="__cf_email__" data-cfemail="5830373b2d37363f69616060183f35393134763b3735">[email&#160;protected]</template></option>
                                                    <option value="usertest@gmail.com"><template class="__cf_email__" data-cfemail="21545244535544525561464c40484d0f424e4c">[email&#160;protected]</template></option>
                                                    <option value="nguyenhuunga23@gmail.com"><template class="__cf_email__" data-cfemail="ff91988a869a91978a8a91989ecdccbf98929e9693d19c9092">[email&#160;protected]</template></option>
                                                    <option value="usertest99@gmail.com"><template class="__cf_email__" data-cfemail="4431372136302137307d7d042329252d286a272b29">[email&#160;protected]</template></option>
                                                    <option value="andykoh11@gmail.com"><template class="__cf_email__" data-cfemail="88e9e6ecf1e3e7e0b9b9c8efe5e9e1e4a6ebe7e5">[email&#160;protected]</template></option>
                                                    <option value="JulietteSisely992535@gmail.com"><template class="__cf_email__" data-cfemail="561c233a3f33222233053f25333a2f6f6f6463656316313b373f3a7835393b">[email&#160;protected]</template></option>
                                                    <option value="SibDaisey173789@gmail.com"><template class="__cf_email__" data-cfemail="02516b6046636b71677b333531353a3b42656f636b6e2c616d6f">[email&#160;protected]</template></option>
                                                    <option value="NariBrita428259@gmail.com"><template class="__cf_email__" data-cfemail="602e011209221209140154525852555920070d01090c4e030f0d">[email&#160;protected]</template></option>
                                                    <option value="FarahMoeller98538@gmail.com"><template class="__cf_email__" data-cfemail="87c1e6f5e6efcae8e2ebebe2f5bebfb2b4bfc7e0eae6eeeba9e4e8ea">[email&#160;protected]</template></option>
                                                    <option value="CyndiIngeberg395148@gmail.com"><template class="__cf_email__" data-cfemail="a0e3d9cec4c9e9cec7c5c2c5d2c7939995919498e0c7cdc1c9cc8ec3cfcd">[email&#160;protected]</template></option>
                                                    <option value="EstelShawn795745@gmail.com"><template class="__cf_email__" data-cfemail="c287b1b6a7ae91aaa3b5acf5fbf7f5f6f782a5afa3abaeeca1adaf">[email&#160;protected]</template></option>
                                                    <option value="RyccaMaggy559093@gmail.com"><template class="__cf_email__" data-cfemail="3163485252507c5056564804040801080271565c50585d1f525e5c">[email&#160;protected]</template></option>
                                                    <option value="GabyGower272293@gmail.com"><template class="__cf_email__" data-cfemail="e1a6808398a68e968493d3d6d3d3d8d2a1868c80888dcf828e8c">[email&#160;protected]</template></option>
                                                    <option value="GlennaRobyn321892@gmail.com"><template class="__cf_email__" data-cfemail="286f444d4646497a474a51461b1a1910111a684f45494144064b4745">[email&#160;protected]</template></option>
                                                    <option value="JulienneVinita451357@gmail.com"><template class="__cf_email__" data-cfemail="ca80bfa6a3afa4a4af9ca3a4a3beabfefffbf9fffd8aada7aba3a6e4a9a5a7">[email&#160;protected]</template></option>
                                                    <option value="BabbPearse577475@gmail.com"><template class="__cf_email__" data-cfemail="84c6e5e6e6d4e1e5f6f7e1b1b3b3b0b3b1c4e3e9e5ede8aae7ebe9">[email&#160;protected]</template></option>
                                                    <option value="StephaniDenice337519@gmail.com"><template class="__cf_email__" data-cfemail="401334253028212e2904252e29232573737775717900272d21292c6e232f2d">[email&#160;protected]</template></option>
                                                    <option value="JaninaEarlie777959@gmail.com"><template class="__cf_email__" data-cfemail="9ed4fff0f7f0ffdbffecf2f7fba9a9a9a7aba7def9f3fff7f2b0fdf1f3">[email&#160;protected]</template></option>
                                                    <option value="CandieBeverie421429@gmail.com"><template class="__cf_email__" data-cfemail="befddfd0dad7dbfcdbc8dbccd7db8a8c8f8a8c87fed9d3dfd7d290ddd1d3">[email&#160;protected]</template></option>
                                                    <option value="MalenaSibel751175@gmail.com"><template class="__cf_email__" data-cfemail="93def2fff6fdf2c0faf1f6ffa4a6a2a2a4a6d3f4fef2faffbdf0fcfe">[email&#160;protected]</template></option>
                                                    <option value="AlamedaShania488220@gmail.com"><template class="__cf_email__" data-cfemail="11507d707c7475704279707f787025292923232151767c70787d3f727e7c">[email&#160;protected]</template></option>
                                                    <option value="NaraCari570281@gmail.com"><template class="__cf_email__" data-cfemail="eaa48b988ba98b9883dfdddad8d2dbaa8d878b8386c4898587">[email&#160;protected]</template></option>
                                                    <option value="tijordynneverdione15@gmail.com"><template class="__cf_email__" data-cfemail="c4b0adaeabb6a0bdaaaaa1b2a1b6a0adabaaa1f5f184a3a9a5ada8eaa7aba9">[email&#160;protected]</template></option>
                                                    <option value="KatineStrangways254267@gmail.com"><template class="__cf_email__" data-cfemail="2962485d40474c7a5d5b48474e5e48505a1b1c1d1b1f1e694e44484045074a4644">[email&#160;protected]</template></option>
                                                    <option value="RosellaRosamund805209@gmail.com"><template class="__cf_email__" data-cfemail="cd9fa2bea8a1a1ac9fa2beaca0b8a3a9f5fdf8fffdf48daaa0aca4a1e3aea2a0">[email&#160;protected]</template></option>
                                                    <option value="GraceTera997446@gmail.com"><template class="__cf_email__" data-cfemail="5017223133350435223169696764646610373d31393c7e333f3d">[email&#160;protected]</template></option>
                                                    <option value="letty.franchesca.shalon12@gmail.com"><template class="__cf_email__" data-cfemail="1c7079686865327a6e7d727f74796f7f7d326f747d7073722d2e5c7b717d7570327f7371">[email&#160;protected]</template></option>
                                                    <option value="tiwanitadefense.this22@gmail.com"><template class="__cf_email__" data-cfemail="295d405e4847405d484d4c4f4c475a4c075d41405a1b1b694e44484045074a4644">[email&#160;protected]</template></option>
                                                    <option value="laci.side.carmelita47@gmail.com"><template class="__cf_email__" data-cfemail="c2aea3a1abecb1aba6a7eca1a3b0afa7aeabb6a3f6f582a5afa3abaeeca1adaf">[email&#160;protected]</template></option>
                                                    <option value="MalyndaFerry749379@gmail.com"><template class="__cf_email__" data-cfemail="ce83afa2b7a0aaaf88abbcbcb7f9faf7fdf9f78ea9a3afa7a2e0ada1a3">[email&#160;protected]</template></option>
                                                    <option value="iola.luciechance41@gmail.com"><template class="__cf_email__" data-cfemail="e68f898a87c88a93858f83858e87888583d2d7a6818b878f8ac885898b">[email&#160;protected]</template></option>
                                                    <option value="IleaneTammie283845@gmail.com"><template class="__cf_email__" data-cfemail="f5bc9990949b90a19498989c90c7cdc6cdc1c0b59298949c99db969a98">[email&#160;protected]</template></option>
                                                    <option value="SariSileas330622@gmail.com"><template class="__cf_email__" data-cfemail="9ac9fbe8f3c9f3f6fffbe9a9a9aaaca8a8dafdf7fbf3f6b4f9f5f7">[email&#160;protected]</template></option>
                                                    <option value="starr.resource.ernesto35@gmail.com"><template class="__cf_email__" data-cfemail="c9babda8bbbbe7bbacbaa6bcbbaaace7acbba7acbabda6fafc89aea4a8a0a5e7aaa6a4">[email&#160;protected]</template></option>
                                                    <option value="SabraKerri783100@gmail.com"><template class="__cf_email__" data-cfemail="2774464555466c4255554e101f1416171767404a464e4b0944484a">[email&#160;protected]</template></option>
                                                    <option value="DarlaFranni538432@gmail.com"><template class="__cf_email__" data-cfemail="521633203e331420333c3c3b67616a66616012353f333b3e7c313d3f">[email&#160;protected]</template></option>
                                                    <option value="kareenalexafirst43@gmail.com"><template class="__cf_email__" data-cfemail="3a515b485f5f545b565f425b5c5348494e0e097a5d575b535614595557">[email&#160;protected]</template></option>
                                                    <option value="TresaMikaela611999@gmail.com"><template class="__cf_email__" data-cfemail="4317312630220e2a2822262f227572727a7a7a03242e222a2f6d202c2e">[email&#160;protected]</template></option>
                                                    <option value="LeliaTallou149340@gmail.com"><template class="__cf_email__" data-cfemail="7d311811141c291c111112084c49444e494d3d1a101c1411531e1210">[email&#160;protected]</template></option>
                                                    <option value="zachariah.understand472768@gmail.com"><template class="__cf_email__" data-cfemail="f68c97959e97849f979ed883989293848582979892c2c1c4c1c0ceb6919b979f9ad895999b">[email&#160;protected]</template></option>
                                                    <option value="DeanaNicolina360898@gmail.com"><template class="__cf_email__" data-cfemail="430726222d220d2a202c2f2a2d227075737b7a7b03242e222a2f6d202c2e">[email&#160;protected]</template></option>
                                                    <option value="clintjanettefact26@gmail.com"><template class="__cf_email__" data-cfemail="492a2520273d2328272c3d3d2c2f282a3d7b7f092e24282025672a2624">[email&#160;protected]</template></option>
                                                    <option value="AverilNovak192911@gmail.com"><template class="__cf_email__" data-cfemail="9ddcebf8eff4f1d3f2ebfcf6aca4afa4acacddfaf0fcf4f1b3fef2f0">[email&#160;protected]</template></option>
                                                    <option value="AnjanetteKarrie936761@gmail.com"><template class="__cf_email__" data-cfemail="74351a1e151a110000113f1506061d114d4742434245341319151d185a171b19">[email&#160;protected]</template></option>
                                                    <option value="tileeanneclaudie.shana28@gmail.com"><template class="__cf_email__" data-cfemail="2b5f42474e4e4a45454e48474a5e4f424e0558434a454a19136b4c464a424705484446">[email&#160;protected]</template></option>
                                                    <option value="XenaCrissie307625@gmail.com"><template class="__cf_email__" data-cfemail="f4ac919a95b7869d87879d91c7c4c3c2c6c1b49399959d98da979b99">[email&#160;protected]</template></option>
                                                    <option value="jacklyn.lorymiss52@gmail.com"><template class="__cf_email__" data-cfemail="81ebe0e2eaedf8efafedeef3f8ece8f2f2b4b3c1e6ece0e8edafe2eeec">[email&#160;protected]</template></option>
                                                    <option value="tijenny.restria43@gmail.com"><template class="__cf_email__" data-cfemail="ed99848788838394c39f889e999f848cd9dead8a808c8481c38e8280">[email&#160;protected]</template></option>
                                                    <option value="ruie.merrileeability99@gmail.com"><template class="__cf_email__" data-cfemail="3f4d4a565a11525a4d4d56535a5a5e5d5653564b4606067f58525e5653115c5052">[email&#160;protected]</template></option>
                                                    <option value="tijonnie.special673713@gmail.com"><template class="__cf_email__" data-cfemail="a7d3cecdc8c9c9cec289d4d7c2c4cec6cb919094909694e7c0cac6cecb89c4c8ca">[email&#160;protected]</template></option>
                                                    <option value="paris.cecilia841936@gmail.com"><template class="__cf_email__" data-cfemail="e09081928993ce838583898c8981d8d4d1d9d3d6a0878d81898cce838f8d">[email&#160;protected]</template></option>
                                                    <option value="tijaren.aletatell43@gmail.com"><template class="__cf_email__" data-cfemail="5b2f32313a293e35753a373e2f3a2f3e37376f681b3c363a323775383436">[email&#160;protected]</template></option>
                                                    <option value="tizackvisitlisten47@gmail.com"><template class="__cf_email__" data-cfemail="e7938e9d86848c918e948e938b8e94938289d3d0a7808a868e8bc984888a">[email&#160;protected]</template></option>
                                                    <option value="ticatharine.dolores314452@gmail.com"><template class="__cf_email__" data-cfemail="4f3b262c2e3b272e3d26212a612b2023203d2a3c7c7e7b7b7a7d0f28222e2623612c2022">[email&#160;protected]</template></option>
                                                    <option value="tilowell.grovermatt49@gmail.com"><template class="__cf_email__" data-cfemail="9febf6f3f0e8faf3f3b1f8edf0e9faedf2feebebaba6dff8f2fef6f3b1fcf0f2">[email&#160;protected]</template></option>
                                                    <option value="tiemilio.argue.752653@gmail.com"><template class="__cf_email__" data-cfemail="512538343c383d383e7f30233624347f66646367646211363c30383d7f323e3c">[email&#160;protected]</template></option>
                                                    <option value="tidenese.springpresent38@gmail.com"><template class="__cf_email__" data-cfemail="83f7eae7e6ede6f0e6adf0f3f1eaede4f3f1e6f0e6edf7b0bbc3e4eee2eaefade0ecee">[email&#160;protected]</template></option>
                                                    <option value="tinery.marisol.we71@gmail.com"><template class="__cf_email__" data-cfemail="43372a2d26313a6d2e22312a302c2f6d3426747203242e222a2f6d202c2e">[email&#160;protected]</template></option>
                                                    <option value="tiaustin.movement.course45@gmail.com"><template class="__cf_email__" data-cfemail="1a6e737b6f696e73743477756c7f777f746e3479756f68697f2e2f5a7d777b737634797577">[email&#160;protected]</template></option>
                                                    <option value="tilinwoodmilitary.violence71@gmail.com"><template class="__cf_email__" data-cfemail="5c28353035322b33333831353035283d2e25722a35333039323f396b6d1c3b313d3530723f3331">[email&#160;protected]</template></option>
                                                    <option value="tishemarmaryellen.quality75@gmail.com"><template class="__cf_email__" data-cfemail="5c28352f3439313d2e313d2e253930303932722d293d303528256b691c3b313d3530723f3331">[email&#160;protected]</template></option>
                                                    <option value="tielwyn.paulita.christopher82@gmail.com"><template class="__cf_email__" data-cfemail="2d594448415a5443035d4c584144594c034e455f445e59425d45485f151f6d4a404c4441034e4240">[email&#160;protected]</template></option>
                                                    <option value="ticleonandmiranda65@gmail.com"><template class="__cf_email__" data-cfemail="45312c2629202a2b242b21282c37242b21247370052228242c296b262a28">[email&#160;protected]</template></option>
                                                    <option value="ticassie.song.dream48@gmail.com"><template class="__cf_email__" data-cfemail="f08499939183839995de839f9e97de948295919dc4c8b0979d91999cde939f9d">[email&#160;protected]</template></option>
                                                    <option value="tieddiecrimedebate62@gmail.com"><template class="__cf_email__" data-cfemail="2e5a474b4a4a474b4d5c47434b4a4b4c4f5a4b181c6e49434f4742004d4143">[email&#160;protected]</template></option>
                                                    <option value="tihillerydraw.eye82@gmail.com"><template class="__cf_email__" data-cfemail="d4a0bdbcbdb8b8b1a6adb0a6b5a3fab1adb1ece694b3b9b5bdb8fab7bbb9">[email&#160;protected]</template></option>
                                                    <option value="tibrennaeldridgewill72@gmail.com"><template class="__cf_email__" data-cfemail="77031e150512191916121b13051e131012001e1b1b404537101a161e1b5914181a">[email&#160;protected]</template></option>
                                                    <option value="tisherwood.shermanthem34@gmail.com"><template class="__cf_email__" data-cfemail="abdfc2d8c3ced9dcc4c4cf85d8c3ced9c6cac5dfc3cec6989febccc6cac2c785c8c4c6">[email&#160;protected]</template></option>
                                                    <option value="gerard.itsgaston23@gmail.com"><template class="__cf_email__" data-cfemail="6f080a1d0e1d0b41061b1c080e1c1b00015d5c2f08020e0603410c0002">[email&#160;protected]</template></option>
                                                    <option value="linton.alma.away24@gmail.com"><template class="__cf_email__" data-cfemail="214d484f554e4f0f404d4c400f40564058131561464c40484d0f424e4c">[email&#160;protected]</template></option>
                                                    <option value="tiantoine.sterling451471@gmail.com"><template class="__cf_email__" data-cfemail="91e5f8f0ffe5fef8fff4bfe2e5f4e3fdf8fff6a5a4a0a5a6a0d1f6fcf0f8fdbff2fefc">[email&#160;protected]</template></option>
                                                    <option value="tihollishis.bert62@gmail.com"><template class="__cf_email__" data-cfemail="54203d3c3b38383d273c3d277a363126206266143339353d387a373b39">[email&#160;protected]</template></option>
                                                    <option value="tibyrdiemargarettelikely51@gmail.com"><template class="__cf_email__" data-cfemail="691d000b101b0d000c04081b0e081b0c1d1d0c0500020c05105c58290e04080005470a0604">[email&#160;protected]</template></option>
                                                    <option value="khloe.let.anthony82@gmail.com"><template class="__cf_email__" data-cfemail="472c2f2b2822692b2233692629332f28293e7f7507202a262e2b6924282a">[email&#160;protected]</template></option>
                                                    <option value="tidorine.or.memory56@gmail.com"><template class="__cf_email__" data-cfemail="91e5f8f5fee3f8fff4bffee3bffcf4fcfee3e8a4a7d1f6fcf0f8fdbff2fefc">[email&#160;protected]</template></option>
                                                    <option value="tifaye.elnora.winford15@gmail.com"><template class="__cf_email__" data-cfemail="82f6ebe4e3fbe7ace7eeecedf0e3acf5ebece4edf0e6b3b7c2e5efe3ebeeace1edef">[email&#160;protected]</template></option>
                                                    <option value="corneliaemogenelow38@gmail.com"><template class="__cf_email__" data-cfemail="87e4e8f5e9e2ebeee6e2eae8e0e2e9e2ebe8f0b4bfc7e0eae6eeeba9e4e8ea">[email&#160;protected]</template></option>
                                                    <option value="nicolas.naturalso90@gmail.com"><template class="__cf_email__" data-cfemail="9ef0f7fdf1f2ffedb0f0ffeaebecfff2edf1a7aedef9f3fff7f2b0fdf1f3">[email&#160;protected]</template></option>
                                                    <option value="helendarlagay70@gmail.com"><template class="__cf_email__" data-cfemail="afc7cac3cac1cbceddc3cec8ced6989fefc8c2cec6c381ccc0c2">[email&#160;protected]</template></option>
                                                    <option value="eliannaexecutive.return14@gmail.com"><template class="__cf_email__" data-cfemail="b7d2dbded6d9d9d6d2cfd2d4c2c3dec1d299c5d2c3c2c5d98683f7d0dad6dedb99d4d8da">[email&#160;protected]</template></option>
                                                    <option value="tishelbie.jacintalupe93@gmail.com"><template class="__cf_email__" data-cfemail="90e4f9e3f8f5fcf2f9f5befaf1f3f9fee4f1fce5e0f5a9a3d0f7fdf1f9fcbef3fffd">[email&#160;protected]</template></option>
                                                    <option value="valoriesalome.meeting61@gmail.com"><template class="__cf_email__" data-cfemail="6a1c0b060518030f190b0605070f44070f0f1e03040d5c5b2a0d070b030644090507">[email&#160;protected]</template></option>
                                                    <option value="tileonila.johana.428274@gmail.com"><template class="__cf_email__" data-cfemail="196d70757c767770757837737671787778372d2b212b2e2d597e74787075377a7674">[email&#160;protected]</template></option>
                                                    <option value="luella.kary978708@gmail.com"><template class="__cf_email__" data-cfemail="3b574e5e57575a15505a4942020c030c0b037b5c565a525715585456">[email&#160;protected]</template></option>
                                                    <option value="kacieart930063@gmail.com"><template class="__cf_email__" data-cfemail="2f444e4c464a4e5d5b161c1f1f191c6f48424e4643014c4042">[email&#160;protected]</template></option>
                                                    <option value="seasonmargeret.876956@gmail.com"><template class="__cf_email__" data-cfemail="2a594f4b594544474b584d4f584f5e04121d1c131f1c6a4d474b434604494547">[email&#160;protected]</template></option>
                                                    <option value="tilarryjerome107702@gmail.com"><template class="__cf_email__" data-cfemail="c0b4a9aca1b2b2b9aaa5b2afada5f1f0f7f7f0f280a7ada1a9aceea3afad">[email&#160;protected]</template></option>
                                                    <option value="tilewischeresoldier60@gmail.com"><template class="__cf_email__" data-cfemail="1165787d746678627279746374627e7d75787463272151767c70787d3f727e7c">[email&#160;protected]</template></option>
                                                    <option value="tianson.billioninside80@gmail.com"><template class="__cf_email__" data-cfemail="3b4f525a554854551559525757525455525548525f5e030b7b5c565a525715585456">[email&#160;protected]</template></option>
                                                    <option value="alixmasako711509@gmail.com"><template class="__cf_email__" data-cfemail="7415181d0c191507151f1b43454541444d341319151d185a171b19">[email&#160;protected]</template></option>
                                                    <option value="tizhanesheldon.311061@gmail.com"><template class="__cf_email__" data-cfemail="82f6ebf8eae3ece7f1eae7eee6edecacb1b3b3b2b4b3c2e5efe3ebeeace1edef">[email&#160;protected]</template></option>
                                                    <option value="tisuzanna.roseanneflorentino33@gmail.com"><template class="__cf_email__" data-cfemail="a1d5c8d2d4dbc0cfcfc08fd3ced2c4c0cfcfc4c7cdced3c4cfd5c8cfce9292e1c6ccc0c8cd8fc2cecc">[email&#160;protected]</template></option>
                                                    <option value="jerodmaterialgeneration40@gmail.com"><template class="__cf_email__" data-cfemail="533936213c373e322736213a323f34363d362132273a3c3d676313343e323a3f7d303c3e">[email&#160;protected]</template></option>
                                                    <option value="tizionizettadrop51@gmail.com"><template class="__cf_email__" data-cfemail="73071a091a1c1d1a091607071217011c03464233141e121a1f5d101c1e">[email&#160;protected]</template></option>
                                                    <option value="tiprudence.martin.alden63@gmail.com"><template class="__cf_email__" data-cfemail="f2869b82808796979c9197dc9f9380869b9cdc939e96979cc4c1b2959f939b9edc919d9f">[email&#160;protected]</template></option>
                                                    <option value="tiherbert.alreadychasity35@gmail.com"><template class="__cf_email__" data-cfemail="790d10111c0b1b1c0b0d5718150b1c181d001a11180a100d004a4c391e14181015571a1614">[email&#160;protected]</template></option>
                                                    <option value="shedrickmartha.656254@gmail.com"><template class="__cf_email__" data-cfemail="addec5c8c9dfc4cec6c0ccdfd9c5cc839b989b9f9899edcac0ccc4c183cec2c0">[email&#160;protected]</template></option>
                                                    <option value="basilia.nelsonmorning96@gmail.com"><template class="__cf_email__" data-cfemail="325053415b5e5b531c5c575e415d5c5f5d405c5b5c550b0472555f535b5e1c515d5f">[email&#160;protected]</template></option>
                                                    <option value="dwainejesenia.office10@gmail.com"><template class="__cf_email__" data-cfemail="234754424a4d46494650464d4a420d4c45454a4046121363444e424a4f0d404c4e">[email&#160;protected]</template></option>
                                                    <option value="diana.lerathird53@gmail.com"><template class="__cf_email__" data-cfemail="27434e464946094b425546534f4e5543121467404a464e4b0944484a">[email&#160;protected]</template></option>
                                                    <option value="jesusarickeyefrain65@gmail.com"><template class="__cf_email__" data-cfemail="ef858a9c9a9c8e9d868c848a968a899d8e8681d9daaf88828e8683c18c8082">[email&#160;protected]</template></option>
                                                    <option value="tibraydon.tessmagan69@gmail.com"><template class="__cf_email__" data-cfemail="cebaa7acbcafb7aaa1a0e0baabbdbda3afa9afa0f8f78ea9a3afa7a2e0ada1a3">[email&#160;protected]</template></option>
                                                    <option value="krissy.ninfa.bit56@gmail.com"><template class="__cf_email__" data-cfemail="513a23382222287f3f383f37307f333825646711363c30383d7f323e3c">[email&#160;protected]</template></option>
                                                    <option value="briandacurrent.616927@gmail.com"><template class="__cf_email__" data-cfemail="60021209010e040103151212050e144e56515659525720070d01090c4e030f0d">[email&#160;protected]</template></option>
                                                    <option value="tivellatheywhich49@gmail.com"><template class="__cf_email__" data-cfemail="b1c5d8c7d4ddddd0c5d9d4c8c6d9d8d2d98588f1d6dcd0d8dd9fd2dedc">[email&#160;protected]</template></option>
                                                    <option value="tarik.finallycarlota42@gmail.com"><template class="__cf_email__" data-cfemail="c9bda8bba0a2e7afa0a7a8a5a5b0aaa8bba5a6bda8fdfb89aea4a8a0a5e7aaa6a4">[email&#160;protected]</template></option>
                                                    <option value="brunatable927412@gmail.com"><template class="__cf_email__" data-cfemail="94f6e6e1faf5e0f5f6f8f1ada6a3a0a5a6d4f3f9f5fdf8baf7fbf9">[email&#160;protected]</template></option>
                                                    <option value="maliyahettieshake33@gmail.com"><template class="__cf_email__" data-cfemail="8ce1ede0e5f5ede4e9f8f8e5e9ffe4ede7e9bfbfccebe1ede5e0a2efe3e1">[email&#160;protected]</template></option>
                                                    <option value="delacruzjoana87@gmail.com"><template class="__cf_email__" data-cfemail="2642434a474554535c4c494748471e1166414b474f4a0845494b">[email&#160;protected]</template></option>
                                                    <option value="ni@888">ni@888</option>
                                                    <option value="Menmoriii3533@gmail.com"><template class="__cf_email__" data-cfemail="3a775f54575548535353090f09097a5d575b535614595557">[email&#160;protected]</template></option>
                                                    <option value="khanhu00@gmail.com"><template class="__cf_email__" data-cfemail="42292a232c2a37727202252f232b2e6c212d2f">[email&#160;protected]</template></option>
                                                    <option value="QuangTrung11@gmail.com"><template class="__cf_email__" data-cfemail="59082c38373e0d2b2c373e6868193e34383035773a3634">[email&#160;protected]</template></option>
                                                    <option value="NariBri*****59@gmail.com">NariBri*****<template class="__cf_email__" data-cfemail="ab9e92ebccc6cac2c785c8c4c6">[email&#160;protected]</template></option>
                                                    <option value="mion@8686">mion@8686</option>
                                                    <option value="JulietteS*****35@gmail.com">JulietteS*****<template class="__cf_email__" data-cfemail="6d5e582d0a000c0401430e0200">[email&#160;protected]</template></option>
                                                    <option value="SibDaisey*****9@gmail.com">SibDaisey*****<template class="__cf_email__" data-cfemail="9da4ddfaf0fcf4f1b3fef2f0">[email&#160;protected]</template></option>
                                                    <option value="and****h11@gmail.com">and****<template class="__cf_email__" data-cfemail="d2bae3e392b5bfb3bbbefcb1bdbf">[email&#160;protected]</template></option>
                                                    <option value="ash****354@gmail.com">ash****<template class="__cf_email__" data-cfemail="192a2c2d597e74787075377a7674">[email&#160;protected]</template></option>
                                                    <option value="FarahM*****38@gmail.com">FarahM*****<template class="__cf_email__" data-cfemail="f5c6cdb59298949c99db969a98">[email&#160;protected]</template></option>
                                                    <option value="sinic****n9687@mail.com">sinic****<template class="__cf_email__" data-cfemail="ec82d5dad4dbac818d8580c28f8381">[email&#160;protected]</template></option>
                                                    <option value="CyndiIn*****5148@gmail.com">CyndiIn*****<template class="__cf_email__" data-cfemail="516460656911363c30383d7f323e3c">[email&#160;protected]</template></option>
                                                    <option value="andyxe****666@gmail.com">andyxe****<template class="__cf_email__" data-cfemail="1325252553747e727a7f3d707c7e">[email&#160;protected]</template></option>
                                                    <option value="akir****88@gmail.com">akir****<template class="__cf_email__" data-cfemail="9ba3a3dbfcf6faf2f7b5f8f4f6">[email&#160;protected]</template></option>
                                                    <option value="EstelSha*****745@gmail.com">EstelSha*****<template class="__cf_email__" data-cfemail="2f181b1a6f48424e4643014c4042">[email&#160;protected]</template></option>
                                                    <option value="ka****a63624@gmail.com">ka****<template class="__cf_email__" data-cfemail="e889dedbdedadca88f85898184c68b8785">[email&#160;protected]</template></option>
                                                    <option value="RyccaM*****093@gmail.com">RyccaM*****<template class="__cf_email__" data-cfemail="1020292350777d71797c3e737f7d">[email&#160;protected]</template></option>
                                                    <option value="asma****at@gmail.com">asma****<template class="__cf_email__" data-cfemail="ea8b9eaa8d878b8386c4898587">[email&#160;protected]</template></option>
                                                    <option value="GabyG*****2293@gmail.com">GabyG*****<template class="__cf_email__" data-cfemail="506262696310373d31393c7e333f3d">[email&#160;protected]</template></option>
                                                    <option value="Glenn*****1892@gmail.com">Glenn*****<template class="__cf_email__" data-cfemail="0b3a3332394b6c666a626725686466">[email&#160;protected]</template></option>
                                                    <option value="con****555@gmail.com">con****<template class="__cf_email__" data-cfemail="98adadadd8fff5f9f1f4b6fbf7f5">[email&#160;protected]</template></option>
                                                    <option value="Julienne*****357@gmail.com">Julienne*****<template class="__cf_email__" data-cfemail="95a6a0a2d5f2f8f4fcf9bbf6faf8">[email&#160;protected]</template></option>
                                                    <option value="mu****asi@gmail.com">mu****<template class="__cf_email__" data-cfemail="6302100a23040e020a0f4d000c0e">[email&#160;protected]</template></option>
                                                    <option value="BabbPe*****475@gmail.com">BabbPe*****<template class="__cf_email__" data-cfemail="55616260153238343c397b363a38">[email&#160;protected]</template></option>
                                                    <option value="ap****ra@gmail.com">ap****<template class="__cf_email__" data-cfemail="84f6e5c4e3e9e5ede8aae7ebe9">[email&#160;protected]</template></option>
                                                    <option value="tha****1929@gmail.com">tha****<template class="__cf_email__" data-cfemail="22131b101b62454f434b4e0c414d4f">[email&#160;protected]</template></option>
                                                    <option value="StephaniD*****7519@gmail.com">StephaniD*****<template class="__cf_email__" data-cfemail="7e494b4f473e19131f1712501d1113">[email&#160;protected]</template></option>
                                                    <option value="mau****a78@gmail.com">mau****<template class="__cf_email__" data-cfemail="5e3f69661e39333f3732703d3133">[email&#160;protected]</template></option>
                                                    <option value="JaninaE*****959@gmail.com">JaninaE*****<template class="__cf_email__" data-cfemail="af969a96efc8c2cec6c381ccc0c2">[email&#160;protected]</template></option>
                                                    <option value="thron****787@gmail.com">thron****<template class="__cf_email__" data-cfemail="3b0c030c7b5c565a525715585456">[email&#160;protected]</template></option>
                                                    <option value="CandieBe*****21429@gmail.com">CandieBe*****<template class="__cf_email__" data-cfemail="2c1e1d181e156c4b414d4540024f4341">[email&#160;protected]</template></option>
                                                    <option value="thua****u66@gmail.com">thua****<template class="__cf_email__" data-cfemail="5025666610373d31393c7e333f3d">[email&#160;protected]</template></option>
                                                    <option value="Malena*****175@gmail.com">Malena*****<template class="__cf_email__" data-cfemail="6c5d5b592c0b010d0500420f0301">[email&#160;protected]</template></option>
                                                    <option value="shaba****hai@gmail.com">shaba****<template class="__cf_email__" data-cfemail="e78f868ea7808a868e8bc984888a">[email&#160;protected]</template></option>
                                                    <option value="AlamedaS*****220@gmail.com">AlamedaS*****<template class="__cf_email__" data-cfemail="84b6b6b4c4e3e9e5ede8aae7ebe9">[email&#160;protected]</template></option>
                                                    <option value="tangk****ag1212@gmail.com">tangk****<template class="__cf_email__" data-cfemail="35545204070407755258545c591b565a58">[email&#160;protected]</template></option>
                                                    <option value="hua****na777@gmail.com">hua****<template class="__cf_email__" data-cfemail="305e5107070770575d51595c1e535f5d">[email&#160;protected]</template></option>
                                                    <option value="NaraC*****281@gmail.com">NaraC*****<template class="__cf_email__" data-cfemail="77454f4637101a161e1b5914181a">[email&#160;protected]</template></option>
                                                    <option value="am****i0912@gmail.com">am****<template class="__cf_email__" data-cfemail="b3da838a8281f3d4ded2dadf9dd0dcde">[email&#160;protected]</template></option>
                                                    <option value="KatineStra*****54267@gmail.com">KatineStra*****<template class="__cf_email__" data-cfemail="d4e1e0e6e2e394b3b9b5bdb8fab7bbb9">[email&#160;protected]</template></option>
                                                    <option value="RosellaRos*****805209@gmail.com">RosellaRos*****<template class="__cf_email__" data-cfemail="e6ded6d3d4d6dfa6818b878f8ac885898b">[email&#160;protected]</template></option>
                                                    <option value="task****1354@gmail.com">task****<template class="__cf_email__" data-cfemail="3d0c0e08097d5a505c5451135e5250">[email&#160;protected]</template></option>
                                                    <option value="GraceTe*****46@gmail.com">GraceTe*****<template class="__cf_email__" data-cfemail="47737107202a262e2b6924282a">[email&#160;protected]</template></option>
                                                    <option value="Hbca****77@gmail.com">Hbca****<template class="__cf_email__" data-cfemail="f7c0c0b7909a969e9bd994989a">[email&#160;protected]</template></option>
                                                    <option value="MalyndaFe*****9@gmail.com">MalyndaFe*****<template class="__cf_email__" data-cfemail="f6cfb6919b979f9ad895999b">[email&#160;protected]</template></option>
                                                    <option value="jok****s789@gmail.com">jok****<template class="__cf_email__" data-cfemail="cbb8fcf3f28baca6aaa2a7e5a8a4a6">[email&#160;protected]</template></option>
                                                    <option value="IleaneTam*****3845@gmail.com">IleaneTam*****<template class="__cf_email__" data-cfemail="a5969d9190e5c2c8c4ccc98bc6cac8">[email&#160;protected]</template></option>
                                                    <option value="Sapt****u612@gmail.com">Sapt****<template class="__cf_email__" data-cfemail="ec99dadddeac8b818d8580c28f8381">[email&#160;protected]</template></option>
                                                    <option value="Aka****suka1212@gmail.com">Aka****<template class="__cf_email__" data-cfemail="d4a7a1bfb5e5e6e5e694b3b9b5bdb8fab7bbb9">[email&#160;protected]</template></option>
                                                    <option value="SariSile*****2@gmail.com">SariSile*****<template class="__cf_email__" data-cfemail="cffd8fa8a2aea6a3e1aca0a2">[email&#160;protected]</template></option>
                                                    <option value="SabraKe*****00@gmail.com">SabraKe*****<template class="__cf_email__" data-cfemail="17272757707a767e7b3974787a">[email&#160;protected]</template></option>
                                                    <option value="tatb****1209@gmail.com">tatb****<template class="__cf_email__" data-cfemail="566764666f16313b373f3a7835393b">[email&#160;protected]</template></option>
                                                    <option value="Gab****hala666@gmail.com">Gab****<template class="__cf_email__" data-cfemail="5038313c3166666610373d31393c7e333f3d">[email&#160;protected]</template></option>
                                                    <option value="DarlaFra*****432@gmail.com">DarlaFra*****<template class="__cf_email__" data-cfemail="8cb8bfbeccebe1ede5e0a2efe3e1">[email&#160;protected]</template></option>
                                                    <option value="raji****ra363@gmail.com">raji****<template class="__cf_email__" data-cfemail="e49685d7d2d7a48389858d88ca878b89">[email&#160;protected]</template></option>
                                                    <option value="TresaMik*****1999@gmail.com">TresaMik*****<template class="__cf_email__" data-cfemail="bc8d858585fcdbd1ddd5d092dfd3d1">[email&#160;protected]</template></option>
                                                    <option value="de****a10000@gmail.com">de****<template class="__cf_email__" data-cfemail="2b4a1a1b1b1b1b6b4c464a424705484446">[email&#160;protected]</template></option>
                                                    <option value="Moh****0000@gmail.com">Moh****<template class="__cf_email__" data-cfemail="211111111161464c40484d0f424e4c">[email&#160;protected]</template></option>
                                                    <option value="LeliaTall*****0@gmail.com">LeliaTall*****<template class="__cf_email__" data-cfemail="fecebe99939f9792d09d9193">[email&#160;protected]</template></option>
                                                    <option value="ele****-10-10@gmail.com">ele****<template class="__cf_email__" data-cfemail="022f33322f333242656f636b6e2c616d6f">[email&#160;protected]</template></option>
                                                
                                                   
                                                    <option value="dangdinhquocduc@gmail.com"><template class="__cf_email__" data-cfemail="5f3b3e31383b3631372e2a303c3b2a3c1f38323e3633713c3032">[email&#160;protected]</template></option>
                                                    <option value="hoanghamobile@gmail.com"><template class="__cf_email__" data-cfemail="ef87808e8188878e82808d86838aaf88828e8683c18c8082">[email&#160;protected]</template></option>
                                                    <option value="nttnhan206@gmail.com"><template class="__cf_email__" data-cfemail="640a10100a0c050a565452240309050d084a070b09">[email&#160;protected]</template></option>
                                                    <option value="anhthitran1986@gmail.com"><template class="__cf_email__" data-cfemail="9bfaf5f3eff3f2efe9faf5aaa2a3addbfcf6faf2f7b5f8f4f6">[email&#160;protected]</template></option>
                                                    <option value="pethy1905@gmail.com"><template class="__cf_email__" data-cfemail="5b2b3e2f33226a626b6e1b3c363a323775383436">[email&#160;protected]</template></option>
                                                    <option value="jennymaddoxtx@gmail.com"><template class="__cf_email__" data-cfemail="5c3639323225313d3838332428241c3b313d3530723f3331">[email&#160;protected]</template></option>
                                                    <option value="vohue915@gmail.com"><template class="__cf_email__" data-cfemail="87f1e8eff2e2beb6b2c7e0eae6eeeba9e4e8ea">[email&#160;protected]</template></option>
                                                    <option value="giadinheva@gmail.com"><template class="__cf_email__" data-cfemail="ccaba5ada8a5a2a4a9baad8caba1ada5a0e2afa3a1">[email&#160;protected]</template></option>
                                                    <option value="jacksonnguyen6789@gmail.com"><template class="__cf_email__" data-cfemail="abc1cac8c0d8c4c5c5ccded2cec59d9c9392ebccc6cac2c785c8c4c6">[email&#160;protected]</template></option>
                                                    <option value="quachthao2901@yahoo.com"><template class="__cf_email__" data-cfemail="0e7f7b6f6d667a666f613c373e3f4e776f666161206d6163">[email&#160;protected]</template></option>
                                                    <option value="tnguyen782003@gmail.com"><template class="__cf_email__" data-cfemail="6f1b01081a160a0158575d5f5f5c2f08020e0603410c0002">[email&#160;protected]</template></option>
                                                    <option value="baothach1986@gmail.com"><template class="__cf_email__" data-cfemail="6b090a041f030a08035a52535d2b0c060a020745080406">[email&#160;protected]</template></option>
                                                    <option value="dungpham0109@gmai.com"><template class="__cf_email__" data-cfemail="8beffee5ecfbe3eae6bbbabbb2cbece6eae2a5e8e4e6">[email&#160;protected]</template></option>
                                                    <option value="kathynguyen@gmail.com"><template class="__cf_email__" data-cfemail="f893998c9081969f8d819d96b89f95999194d69b9795">[email&#160;protected]</template></option>
                                                    <option value="liang86.lt@gmail.com"><template class="__cf_email__" data-cfemail="e78b8e868980dfd1c98b93a7808a868e8bc984888a">[email&#160;protected]</template></option>
                                                    <option value="trungnguyencf126@gmail.com"><template class="__cf_email__" data-cfemail="add9dfd8c3cac3cad8d4c8c3cecb9c9f9bedcac0ccc4c183cec2c0">[email&#160;protected]</template></option>
                                                    <option value="jennythaisd@gmail.com"><template class="__cf_email__" data-cfemail="f399969d9d8a879b929a8097b3949e929a9fdd909c9e">[email&#160;protected]</template></option>
                                                    <option value="Nancynguyen1971@gmail.com"><template class="__cf_email__" data-cfemail="bef0dfd0ddc7d0d9cbc7dbd08f87898ffed9d3dfd7d290ddd1d3">[email&#160;protected]</template></option>
                                                    <option value="lycambinh527bramptonroad@gmail.com"><template class="__cf_email__" data-cfemail="711d0812101c13181f194443461303101c01051e1f031e101531161c10181d5f121e1c">[email&#160;protected]</template></option>
                                                    <option value="mophat2014@yahoo.com"><template class="__cf_email__" data-cfemail="e984869981889ddbd9d8dda99088818686c78a8684">[email&#160;protected]</template></option>
                                                    <option value="sungthimy24092005@gmail.com"><template class="__cf_email__" data-cfemail="d9aaacb7beadb1b0b4a0ebede9e0ebe9e9ec99beb4b8b0b5f7bab6b4">[email&#160;protected]</template></option>
                                                    <option value="chanvannguyen96@gmail.com"><template class="__cf_email__" data-cfemail="34575c555a42555a5a53414d515a0d02745359555d581a575b59">[email&#160;protected]</template></option>
                                                    <option value="vothigiac1971@gmail.com"><template class="__cf_email__" data-cfemail="41372e352928262820227078767001262c20282d6f222e2c">[email&#160;protected]</template></option>
                                                    <option value="blancmatthew3402@yahoo.com"><template class="__cf_email__" data-cfemail="31535d505f525c50454559544602050103714850595e5e1f525e5c">[email&#160;protected]</template></option>
                                                    <option value="g@g.g"><template class="__cf_email__" data-cfemail="c2a582a5eca5">[email&#160;protected]</template></option>
                                                    <option value="12345@g.g"><template class="__cf_email__" data-cfemail="8bbab9b8bfbecbeca5ec">[email&#160;protected]</template></option>
                                                    <option value="123456@g.g"><template class="__cf_email__" data-cfemail="5766656463626117307930">[email&#160;protected]</template></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-from-label" for="name"><?=tran("Emails")?> (<?=tran("Subscribers")?>)</label>
                                            <div class="col-sm-10">
                                                <select class="form-control aiz-selectpicker" name="subscriber_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                                   
                                                    <option value="diem38850@gmail.com"><template class="__cf_email__" data-cfemail="eb8f828e86d8d3d3dedbab8c868a8287c5888486">[email&#160;protected]</template></option>
                                                    <option value="hcparis13@hotmail.fr"><template class="__cf_email__" data-cfemail="7c141f0c1d0e150f4d4f3c141308111d1510521a0e">[email&#160;protected]</template></option>
                                                    <option value="ntminh268@gmail.com"><template class="__cf_email__" data-cfemail="630d170e0a0d0b51555b23040e020a0f4d000c0e">[email&#160;protected]</template></option>
                                                    <option value="VIETINFO1370@GMAIL.COM"><template class="__cf_email__" data-cfemail="2f79666a7b666169601e1c181f6f68626e6663016c6062">[email&#160;protected]</template></option>
                                                    <option value="kimgary@hotmail.com"><template class="__cf_email__" data-cfemail="b0dbd9ddd7d1c2c9f0d8dfc4ddd1d9dc9ed3dfdd">[email&#160;protected]</template></option>
                                                    <option value="mynhuyeu@gmail.com"><template class="__cf_email__" data-cfemail="75180c1b1d000c1000351218141c195b161a18">[email&#160;protected]</template></option>
                                                    <option value="iowan7043@gmail.com"><template class="__cf_email__" data-cfemail="fe9791899f90c9cecacdbe99939f9792d09d9193">[email&#160;protected]</template></option>
                                                    <option value="ktttbui12@gmail.com"><template class="__cf_email__" data-cfemail="452e31313127302c7477052228242c296b262a28">[email&#160;protected]</template></option>
                                                    <option value="Kevinlocle2507@gmail.com"><template class="__cf_email__" data-cfemail="420927342b2c2e2d212e277077727502252f232b2e6c212d2f">[email&#160;protected]</template></option>
                                                    <option value="jimmyloc0329@gmail.com"><template class="__cf_email__" data-cfemail="4d272420203421222e7d7e7f740d2a202c2421632e2220">[email&#160;protected]</template></option>
                                                    <option value="phuongnam052876@gmail.com"><template class="__cf_email__" data-cfemail="2a5a425f45444d444b471a1f18121d1c6a4d474b434604494547">[email&#160;protected]</template></option>
                                                    <option value="taratranluu@gmail.com"><template class="__cf_email__" data-cfemail="33475241524741525d5f464673545e525a5f1d505c5e">[email&#160;protected]</template></option>
                                                    <option value="lananguyen9255@gmail.com"><template class="__cf_email__" data-cfemail="167a7778777871636f73782f24232356717b777f7a3875797b">[email&#160;protected]</template></option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-from-label" for="subject"><?=tran("Newsletter subject")?></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="subject" id="subject" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-from-label" for="name"><?=tran("Newsletter content")?></label>
                                            <div class="col-sm-10">
                                                <textarea rows="8" class="form-control aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]], ["insert", ["link", "picture"]],["view", ["undo","redo"]]]' name="content" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 text-right">
                                            <button type="submit" class="btn btn-primary"><?=tran("Send")?></button>
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



    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
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