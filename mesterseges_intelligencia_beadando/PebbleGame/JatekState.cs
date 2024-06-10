using PebbleGame.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.PebbleGame
{
    public class JatekState : State
    {
        public const char BLANK = ' ';
        public const char PLAYER1 = 'X';
        public const char PLAYER2 = 'O';

        public char[] Board { get; set; }

        public JatekState()
        {
            Board = new char[32] { BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, BLANK, };
            CurrentPlayer = PLAYER1;
        }

        public void ChangePlayer()
        {
            if (CurrentPlayer == PLAYER1)
                CurrentPlayer = PLAYER2;
            else
                CurrentPlayer = PLAYER1;
        }

        public override object Clone()
        {
            JatekState newState = new JatekState();

            newState.CurrentPlayer = CurrentPlayer;

            newState.Board = Board.Clone() as char[];

            return newState;
        }

        public override bool Equals(object obj)
        {
            if (obj == null || !(obj is JatekState)) return false;

            JatekState state = obj as JatekState;

            if (CurrentPlayer != state.CurrentPlayer)
                return false;

            for (int i = 0; i < 32; i++)
            {
                if (Board[i] != state.Board[i])
                    return false;
            }
            return true;
        }

        public override string ToString()
        {
            StringBuilder sb = new StringBuilder();
            sb.AppendLine("  1  2  3  4  5  6  7  8  9  10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32");

            sb.AppendLine("-" + new string('-', 96) + "-");

            sb.Append("| ");
            for (int i = 0; i < 32; i++)
            {
                sb.AppendFormat("{0} |", Board[i]);
            }
            sb.AppendLine();

            sb.AppendLine("-" + new string('-', 96) + "-");

            sb.AppendLine($"Current Player: {CurrentPlayer}");

            return sb.ToString();
        }

        public override Status GetStatus()
        {
            JatekOperatorGenerator o = new JatekOperatorGenerator();

            foreach (JatekOperator jo in o.Operators)
            {
                if (jo.Player == CurrentPlayer && jo.IsApplicable(this))
                {
                    return Status.PLAYING;
                }
            }

            if (CurrentPlayer == PLAYER1)
            {
                return Status.PLAYER2WINS;
            }

            return Status.PLAYER1WINS;
        }

        public override int GetHeuristics(char player)
        {
            int score = 0;

            for (int i = 0; i < 32; i++)
            {
                if (Board[i] == BLANK) continue;

                int emptyNeighbors = 0;
                if (i > 0 && Board[i - 1] == BLANK) emptyNeighbors++;
                if (i < 31 && Board[i + 1] == BLANK) emptyNeighbors++;

                if (Board[i] == player)
                    score += emptyNeighbors;
                else
                    score -= emptyNeighbors;
            }
            //Jobb heuristics, ahol megnézi, hogy mit léphet a játékos és ez alapján dönt
            //JatekOperatorGenerator o = new JatekOperatorGenerator();

            //foreach (JatekOperator jo in o.Operators)
            //{
            //    if (jo.Player == CurrentPlayer && jo.IsApplicable(this))
            //    {
            //        JatekState simulatedState = new JatekState();
            //        simulatedState.Board[jo.X] = player;

            //        int moveScore = GetBetterHeuristics(simulatedState, player);

            //        score += moveScore;
            //    }
            //}

            return score;
        }

        private int GetBetterHeuristics(JatekState state, char player)
        {
            int score = 0;

            for (int i = 0; i < 32; i++)
            {
                if (state.Board[i] == BLANK)
                {
                    int emptyNeighbors = 0;
                    if (i > 0 && state.Board[i - 1] == BLANK) emptyNeighbors++;
                    if (i < 31 && state.Board[i + 1] == BLANK) emptyNeighbors++;

                    if (state.Board[i] == player)
                    {
                        score += emptyNeighbors;
                    }
                    else
                    {
                        score -= emptyNeighbors;
                    }
                }
            }

            JatekState opponentState = (JatekState)state.Clone();

            int randomEmptyCell = -1;
            while (randomEmptyCell == -1)
            {
                int randomIndex = new Random().Next(0, 32);
                if (opponentState.Board[randomIndex] == BLANK)
                {
                    randomEmptyCell = randomIndex;
                }
            }

            opponentState.Board[randomEmptyCell] = (player == 'X') ? 'O' : 'X';

            int opponentMoveScore = GetBetterHeuristics(opponentState, (player == 'X') ? 'O' : 'X');
            score -= opponentMoveScore;

            return score;
        }
    }
}
