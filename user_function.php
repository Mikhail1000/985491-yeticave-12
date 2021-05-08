<?php
function format_price(int $price): string {
    $price = ceil($price);
    if ($price < 1000) {
        return $price . ' ₽';
    }
    return number_format($price, 0, ".", " ") . ' ₽';
}

function get_dt_range(string $date_end): array {
    $diff = strtotime($date_end) - strtotime("now");
    $end_time = [floor($diff/3600), floor(($diff % 3600)/60)];

    if ($end_time[0] < 0 || $end_time[1] < 0) {
    	$end_time[0] = 0;
    	$end_time[1] = 0;
    }

    if ($end_time[0] <10) {
        $end_time[0] = '0' . $end_time[0];
    }
    if ($end_time[1] <10) {
        $end_time[1] = '0' . $end_time[1];
    }


    return $end_time;
}

function get_dt_range_with_seconds(string $date_end): array {
    $diff = strtotime($date_end) - strtotime("now");
    $end_time = [floor($diff/3600), floor(($diff % 3600)/60), floor(($diff % 3600)%60)];

    if ($end_time[0] < 0 || $end_time[1] < 0 || $end_time[2] < 0) {
    	$end_time[0] = '00';
    	$end_time[1] = '00';
    	$end_time[2] = '00';
    	return $end_time;
    }

    if ($end_time[0] <10) {
        $end_time[0] = '0' . $end_time[0];
    }
    if ($end_time[1] <10) {
        $end_time[1] = '0' . $end_time[1];
    }
    if ($end_time[2] <10) {
        $end_time[2] = '0' . $end_time[2];
    }

    return $end_time;
}

function get_post_val(string $name): string {
    return $_POST[$name] ?? "";
}

function get_filtered_post_val(string $name): string {
    return htmlspecialchars(get_post_val($name)) ?? "";
}

function get_filtered_get_val(string $name): string {
    return htmlspecialchars($_GET[$name]) ?? "";
}

function validation_format_date(string $date): ?string {
   	if (date_create_from_format('Y-m-d', $date) === false) {
   		return 'Дата должна быть введена в формате "ГГГГ-ММ_ДД"';
   	}

   	return NULL;
}

//здесь не указан тип возвращаемого значения т.к. при указании string выдает ошибку, я так понимаю что когда ошибки нет он возвращает NULL
function validate_filled(string $name): ?string {
    if (empty($_POST[$name])) {
        return 'Поле не заполнено ';
    }

    return NULL;
}

function validate_filled_GET(string $name): ?string {
    if (empty($_GET[$name])) {
        return 'Поле не заполнено ';
    }

    return NULL;
}



function get_timer_value(array $hours_and_minuts): string {
    return implode(':', $hours_and_minuts) ?? "";
}
