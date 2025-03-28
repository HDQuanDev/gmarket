<?php
header("Content-type: application/json");
include("../config.php");
if(isset($_GET['id'])){
    $checkExist=fetch_array("SELECT * FROM address WHERE id='{$_GET['id']}' LIMIT 1");
    if(!$checkExist)die();
}
else die();
?>
{
    "data": {
        "address_data": {
            "id": <?=$checkExist['id']?>,
            "user_id": <?=$checkExist['user_id']?>,
            "address": "<?=$checkExist['address']?>",
            "country_id": null,
            "state_id": null,
            "city_id": null,
            "longitude": null,
            "latitude": null,
            "postal_code": "<?=$checkExist['post_code']?>",
            "phone": "<?=$checkExist['phone']?>",
            "set_default": 0,
            "created_at": "2024-10-09T04:38:24.000000Z",
            "updated_at": "2024-10-09T04:38:24.000000Z"
        },
        "states": [],
        "cities": []
    },
    "html": "<form class='form-default' role='form' action='/users/address_update.php?id=/ <?=$checkExist['id']?> ' method='POST'>\n    <input type=\"hidden\" name=\"_token\" value=\"TohEyFqLbZc1M1LCWTXs2GqI9mbQdw0QMEUti8qf\">    <div class=\"p-3\">\n        <div class='row'>\n            <div class='col-md-2'>\n                <label>Address<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <textarea class=\"form-control mb-3\" placeholder=\"Your Address\" rows=\"2\" name=\"address\" required><?=$checkExist['address']?><\/textarea>\n            <\/div>\n        <\/div>\n        <div class=\"row\">\n            <div class=\"col-md-2\">\n                <label>Country<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <div class=\"mb-3\">\n                    <select class=\"form-control aiz-selectpicker\" data-live-search=\"true\" data-placeholder=\"Select your country\" name=\"country_id\" id=\"edit_country\" required>\n                        <option value=\"\">Select your country<\/option>\n                                                <option value=\"USA\" >\n                            United States\n                        <\/option>\n                                                <option value=\"VN\" >\n                            Vietnam\n                        <\/option>\n                                            <\/select>\n                <\/div>\n            <\/div>\n        <\/div>\n\n        <div class=\"row\">\n            <div class=\"col-md-2\">\n                <label>State<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <select class=\"form-control mb-3 aiz-selectpicker\" name=\"state_id\" id=\"edit_state\"  data-live-search=\"true\" required>\n                                    <\/select>\n            <\/div>\n        <\/div>\n\n        <div class=\"row\">\n            <div class=\"col-md-2\">\n                <label>City<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <select class=\"form-control mb-3 aiz-selectpicker\" data-live-search=\"true\" name=\"city_id\" required>\n                                    <\/select>\n            <\/div>\n        <\/div>\n        \n                \n        <div class=\"row\">\n            <div class=\"col-md-2\">\n                <label>Postal code<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <input type=\"text\" class=\"form-control mb-3\" placeholder=\"Your Postal Code\" value=\"<?=$checkExist['post_code']?>\" name=\"postal_code\" value=\"\" required>\n            <\/div>\n        <\/div>\n        <div class=\"row\">\n            <div class=\"col-md-2\">\n                <label>Phone<\/label>\n            <\/div>\n            <div class=\"col-md-10\">\n                <input type=\"text\" class=\"form-control mb-3\" placeholder=\"+880\" value=\"<?=$checkExist['phone']?>\" name=\"phone\" value=\"\" required>\n            <\/div>\n        <\/div>\n        <div class=\"form-group text-right\">\n            <button type=\"submit\" class=\"btn btn-sm btn-primary\">Save<\/button>\n        <\/div>\n    <\/div>\n<\/form>"
}