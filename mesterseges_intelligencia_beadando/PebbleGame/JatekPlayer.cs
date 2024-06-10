using PebbleGame.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.PebbleGame
{
    public class JatekPlayer
    {
        private Solver solver;

        public JatekPlayer()
        {
            solver = new MiniMax(new JatekOperatorGenerator(), 3);
        }

        public void Play()
        {
            State state = new JatekState();

            Console.WriteLine(state);

            while (state.GetStatus() == Status.PLAYING)
            {
                Operator o;
                do
                {
                    int x = 0;
                    do
                    {
                        Console.Write("X: ");
                    } while (!int.TryParse(Console.ReadLine(), out x));
                    if (x < 1)
                        x = 1;
                    if (x > 32)
                        x = 32;
                    o = new JatekOperator(x - 1, JatekState.PLAYER1);

                } while (!o.IsApplicable(state));

                state = o.Apply(state);

                Console.WriteLine(state);

                if (CheckStatus(state)) break;

                state = solver.NextMove(state);

                Console.WriteLine(state);

                if (CheckStatus(state)) break;
            }
        }
        private bool CheckStatus(State state)
        {
            if (state.GetStatus() == Status.PLAYER1WINS)
            {
                Console.WriteLine("PLAYER1 WON");
                return true;
            }
            if (state.GetStatus() == Status.PLAYER2WINS)
            {
                Console.WriteLine("PLAYER2 WON");
                return true;
            }

            return false;
        }
    }
}
