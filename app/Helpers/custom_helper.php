<?php

function toggleFlashData($show, $duration,) {
    echo '
        <script>
            setTimeout(() => {
                $(".flashdata-message").addClass("active");
            }, '.$show.');
            setTimeout(() => {
                $(".flashdata-message").removeClass("active");
            }, '.$duration.');
        </script>
    ';
}

function readFlashData($flashdata) {
    if (!empty($flashdata)) {
        if (is_array($flashdata['message'])) {
            $message = '';
            foreach ($flashdata['message'] as $msg) {
                $message .= '
                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bx-x"></i>
                        <p class="mb-0">'.$msg.'</p>
                    </div>
                ';
            }
            echo '
            <div class="flashdata-message ' . $flashdata['status'] . '">
                <div class="message-content">
                    <ul>' . $message . '</ul>
                </div>
            </div>
            ';
        } else {
            echo '
            <div class="flashdata-message ' . $flashdata['status'] . '">
                <div class="message-content">' . $flashdata['message'] . '</div>
            </div>
            ';
        }

        if(array_key_exists('scrollTo', $flashdata) && !empty($flashdata['scrollTo'])) {
            scrollToDiv($flashdata['scrollTo']);
        }

    }
    toggleFlashData(100, 5000);
}

function scrollToDiv($div) {
    echo '
        <script>

            setTimeout(() => {
                const scrollToElement = $("#" + "'.$div.'");
                if (scrollToElement.length > 0) {
                    $("html, body").scrollTop(scrollToElement.offset().top - 200);
                }
            });

        </script>
    ';
}

function format_position($id) {
    switch($id) {
        case 1: 
            return 'Dean';
            break;
        case 2: 
            return 'Adviser';
            break;
        case 3:
            return 'President';
            break;
        case 4:
            return 'Developer';
            break;
        case 5:
            return 'Secretary';
            break;
        case 6:
            return 'Vice President Internal';
            break;
        case 7:
            return 'Vice President External';
            break;
        case 8:
            return 'Editor in Chief';
            break;
        case 9:
            return 'Managing Editor';
            break;
    }
}

function format_field_value($array, $field) {
     if(is_array($array)) {
        return ($array != null) ? $array[$field] : '';
     }
     if(is_object($array)) {
        return ($array != null) ? $array->$field : '';
     }
}

function format_bulletin_category($num) {
    return ($num == 1) ? 'announcements' : (($num == 2) ? 'news' : '');
}

function format_timestamp_to_data($dt) {
    $dateTime = new DateTime($dt);
    return $dateTime->format('F j, Y');
}
