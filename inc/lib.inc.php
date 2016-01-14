<?php

function makeCalendar($month, $year) {
  global $self;
  global $mysqli;

  $month_name = array(
          "1" => "Январь",
          "2" => "Февраль",
          "3" => "Март",
          "4" => "Апрель",
          "5" => "Май",
          "6" => "Июнь",
          "7" => "Июль",
          "8" => "Август",
          "9" => "Сентябрь",
          "10" => "Октябрь",
          "11" => "Ноябрь",
          "12" => "Декабрь"
        ); 

  $first_of_month = mktime(0, 0, 0, $month, 1, $year);
  $maxdays = date('t', $first_of_month); // Количество дней в указанном месяце
  $date_info = getdate($first_of_month); // Информация о дате/времени в массиве
  $month = $date_info['mon'];
  $year = $date_info['year'];
     
  $calendar = "
    <div>
      <table width='390px' height='280px' style='border: 1px solid #cccccc';>
          <tr style='background: #8B8970;'>
              <td colspan='7' class='navi'>"
                  .$month_name[$month]." ".$year."
              </td>
          </tr>
          <tr>
              <td class='datehead'>Пн</td>
              <td class='datehead'>Вт</td>
              <td class='datehead'>Ср</td>
              <td class='datehead'>Чт</td>
              <td class='datehead'>Пт</td>
              <td class='datehead'>Сб</td>
              <td class='datehead'>Вс</td>
          </tr>
          <tr>"; 

  $class = ""; //для класса css
  $weekday = $date_info['wday'];

  // Приводим числа к формату 1-понедельник,...,6-суббота 
  $weekday = $weekday - 1;
  if($weekday == -1) { $weekday = 6; }

  $day = 1; // устанавливаем текущий день в еденицу

  // ширина 
  if($weekday > 0) {
    $calendar .= "<td colspan='$weekday'> </td>";
  }
    
  while($day <= $maxdays) {
    if($weekday == 7) {
      $calendar .= "</tr><tr>";
      $weekday = 0;
    }  

    // выборка из базы
    $sql = "SELECT SUBSTRING(`date`, 9, 2) as day, `event_name`, `id`
            FROM random_dates 
            WHERE SUBSTRING(`date`, 6, 2) = ".$month." 
            AND SUBSTRING(`date`, 1, 4) = ".$year;

    if($res = $mysqli->query($sql)){
     $days_array = [];
      while ($row = $res->fetch_assoc()){
        $id = (int)$row['day'];
        $days_array[] = $row['day'];
        $event[$id] = $row['event_name'];
      }
    }

    $title = '';
    $style = '';
   
    // проверка дата текущая дата, даты из базы 
    $linkDate = mktime(0, 0, 0, $month, $day, $year);
    if($day == date('j') && $month == date('n') && $year == date('Y')){
      $class = "caltoday";
    } elseif(in_array($day, $days_array)){
      $style = "style='color: #00BFFF';";
      $class = "newdays";
      $title .= "title=\"$event[$day]\"";   
    } else {
      $class = "cal";
    }
    
    //проверка на выходные дни сб и вс, помечаем красным
    if($weekday == 5 || $weekday == 6) {
      $class = "holidays";
    }
   
    $calendar .= "<td class='{$class}' $title $style><span>{$day}</span></td>";
    $day++;
    $weekday++; 
  }

  if($weekday != 7) {
    $calendar .= "<td colspan='" . (7 - $weekday) . "'> </td>";
  }

  $calendar .= "</tr></div></table>";
  return $calendar; 
}

function has_presence_string($value){
  return isset($value) && $value !== "";
}

function selectDate($month, $year){
  global $self;
  
  $months = array('Январь', 'Февраль', 'Март', 
                'Апрель', 'Май', 'Июнь', 'Июль', 
                'Август', 'Сентябрь', 'Октябрь', 
                'Ноябрь', 'Декабрь');

  $result = "<form style=action='$self' method='get'>
          <select name='month'>";
  
  for($i=0; $i<=11; $i++) {
    $result .= "<option value='".($i+1)."'";
    if($month == $i+1) {
      $result .= "selected = 'selected'";
    }
    $result .= ">".$months[$i]."</option>";
  }
    
  $result .= "</select><select name='year'>";

  for($i=date('Y'); $i<=(date('Y')+20); $i++) {
    $selected = ($year == $i ? "selected = 'selected'" : '');
  
    $result .= "<option value=\"".($i)."\"$selected>".$i."</option>";
  }

  $result .= "</select><input type='submit' value='смотреть' /></form>";

  if($month != date('m') || $year != date('Y'))
    $result .= "<a href='".$self."?month=".date('m')."&year=".date('Y')."'>Вернуться к текущей дате</a>";
  
  return $result;
}