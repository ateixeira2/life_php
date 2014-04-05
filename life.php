#!/usr/bin/env php
<?php
// life.php for lol in /home/teixei_a/projet/le_jeu_de_la_vie/teixei_a
// 
// Made by Alexandre Teixeira
// Login   <teixei_a@etna-alternance.net>
// 
// Started on  Mon Dec  2 14:41:43 2013 Alexandre Teixeira
// Last update Tue Dec  3 16:58:14 2013 Alexandre Teixeira
//
define("X", 20);
define("Y", 20);

system("clear");
run();

// Fonction principale du programme, c'est une boucle infinie.
function run() {
  $grid = init_grid(); // On remplit un tableau à deux dimensions de valeurs aléatoires comprises entre 0 et 1

  while (true) {
    evolve($grid); // On fait évoluer les cellules.
    draw_grid($grid); // On dessine l'état des cellules
    usleep(200000); // On coupe le programme pendant 0,2 secondes pour ne pas saturer le processeur
    system("clear"); // On efface le terminal
  }
}

function init_grid() {
  $grid = array();

  for ($j = 0; $j < Y; ++$j) {
    $grid[$j] = array();
    for ($i = 0; $i < X; ++$i) {
      $grid[$j][$i] = rand(0, 1);
    }
  }
  return $grid;
}

function draw_grid($grid) {
  for ($j = 0; $j < Y; ++$j) {
    for ($i = 0; $i < X; ++$i) {
      if ($grid[$j][$i] == 1) {
	echo "*";
      }
      else
	echo " ";
    }
    echo "\n";
  }
}

function evolve(&$grid) {
  $grid2 = $grid;
  for($j = 0; $j < Y; ++$j) {
    for($i = 0; $i < X; ++$i) {
      $grid[$j][$i] = check($j, $i, $grid2);
    }
  }
  return($grid);
}

function check($j, $i, $grid) {
  $L = $j +1;
  $R = $i +1;
  $c = 0;
  for ($l = $j - 1; $l <= $L; $l++) {
    for ($r =$i - 1; $r <= $R; $r++) {
      if ($grid[$l][$r] == 1) {
	$c++;
      }
    }
  }
  $nbr = $c - $grid[$j][$i];
  if ($nbr ==  3) {
    $result = 1;
  }
  else if ($nbr == 2) {
  $result = $grid[$j][$i];
  }
  else
    $result =0;
  return ($result);
}
