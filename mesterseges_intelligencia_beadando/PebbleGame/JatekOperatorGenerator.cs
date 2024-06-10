using PebbleGame.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.PebbleGame
{
    public class JatekOperatorGenerator : OperatorGenerator
    {
        public List<Operator> Operators { get; }

        public JatekOperatorGenerator()
        {
            Operators = new List<Operator>();

            for (int i = 0; i < 32; i++)
            {
                Operators.Add(new JatekOperator(i, JatekState.PLAYER1));
                Operators.Add(new JatekOperator(i, JatekState.PLAYER2));
            }
        }
    }
}
