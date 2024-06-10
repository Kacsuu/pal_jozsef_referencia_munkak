using PebbleGame.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.PebbleGame
{
    public class JatekOperator : Operator
    {
        public int X { get; set; }

        public char Player { get; set; }

        public JatekOperator(int x, char player)
        {
            X = Math.Min(x, 32);
            Player = player;
        }

        public State Apply(State state)
        {
            if (state == null || !(state is JatekState)) throw new Exception("Not good");

            JatekState newState = state.Clone() as JatekState;

            newState.Board[X] = Player;
            newState.ChangePlayer();

            return newState;
        }

        public bool IsApplicable(State state)
        {
            if (state == null || !(state is JatekState)) return false;

            JatekState jatekState = state as JatekState;

            if (jatekState.Board[X] != JatekState.BLANK)
                return false;

            if (X < 0 || X > 31)
            {
                return false;
            }

            if (X == 0)
            {
                return jatekState.Board[X + 1] == JatekState.BLANK;
            }

            if (X == 31)
            {
                return jatekState.Board[X - 1] == JatekState.BLANK;
            }

            if (X == 0 && jatekState.Board[X + 1] == JatekState.BLANK)
                return true;

            if (X == 31 && jatekState.Board[X - 1] == JatekState.BLANK)
                return true;

            if (jatekState.Board[X - 1] == JatekState.BLANK && jatekState.Board[X + 1] == JatekState.BLANK)
                return true;

            return false;
        }
    }
}
