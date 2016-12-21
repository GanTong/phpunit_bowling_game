<?php

use App\BowlingGame;

class BowlingGameTest extends PHPUnit_Framework_TestCase 

{


	private $game;

	public function setUp()

		{

			$this->game = new BowlingGame();

		}


	/** @test */

	function  it_scores_a_gutter_game_as_zero()
	
	{

		$this->rollTimes(20, 0);

		$this->assertEquals(0, $this->game->score());

	}


		/** @test */

	function it_scores_the_sum_of_all_knocked_down_pins_for_a_game()
	
	{

		$this->rollTimes(20, 1);

		$this->assertEquals(20, $this->game->score());

	}

			/** @test */

	function it_awards_a_one_roll_bonus_for_every_spare()
	{
		$this->rollSpare();
		$this->game->roll(5);

		$this->rollTimes(17, 0);

		$this->assertEquals(20, $this->game->score());
	}


				/** @test */

	function it_awards_a_two_roll_bonus_for_a_strike_in_the_previous_frame()
	{
		$this->rollStrike(10);
		$this->game->roll(7);
		$this->game->roll(2);

		$this->rollTimes(17, 0);

		$this->assertEquals(28, $this->game->score());
	}
	

					/** @test */

	function it_scores_a_perfect_game()
	{
		$this->rollTimes(12, 10);

		$this->assertEquals(300, $this->game->score());

	}

					/** @test */

	function it_takes_exception_with_invalid_rolls()
	{

		//$this->assertEquals($this->fail('InvalidArgumentException'), $this->game->roll(-10));

		$this->assertEquals($this->expectException(InvalidArgumentException::class), $this->game->roll(-10));

	}

	/**
	* @param $count
	* @param $pins
	*/

	public function rollTimes($count, $pins)
	{

		for ($i = 0; $i < $count; $i++)
		{
			$this->game->roll($pins);
		}
	
	}


		//condition for rolling a spare
		private function rollSpare()
		{
		
		$this->game->roll(2);
		$this->game->roll(8);
		
		}

		//condition for rolling a strike
		private function rollStrike()
		{
		
		$this->game->roll(10);
		
		}

}

