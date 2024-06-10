using PebbleGame.PebbleGame;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame
{
    internal class Program
    {
        static void Main(string[] args)
        {
            JatekPlayer player = new JatekPlayer();

            player.Play();
            Console.ReadLine();
        }
    }
}
