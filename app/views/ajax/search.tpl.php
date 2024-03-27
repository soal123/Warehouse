<?php foreach($result as $item): ?>
    <tr>

      <th scope="row"><?=$item['id'];?></th>
      <td>
          <a href='item?id=<?=$item['id'];?>' target='_blank'>
            <?=h($item['name']);?>
          </a>
      </td>
      <!--<td><?php //echo $item['sort']; ?></td> -->
      <!--<td><?=$item['initial count'];?></td>-->
      <!--<td><?=$item['current count'];?></td>-->
      <td><?=$item['separate in order'];?></td>
      <td><?=$item['fact'];?></td>
      <td style='color: #FFBF00;'><?=$item['count_1c'];?></td>
      <?php if (($item['fact']+$item['separate in order'])>$item['count_1c']): ?>
        <td style="color: blue;"><?=($item['fact']+$item['separate in order']-$item['count_1c'])?></td>
      <?php elseif(($item['fact']+$item['separate in order'])==$item['count_1c']): ?>
        <td style="color: green;"><?=0?></td>
      <?php else: ?>
        <td style="color: red;"><?=($item['fact']+$item['separate in order']-$item['count_1c'])?></td>
      <?php endif; ?>
      <td><?=h($item['place']);?></td>

    </tr>
<?php endforeach; ?>

















