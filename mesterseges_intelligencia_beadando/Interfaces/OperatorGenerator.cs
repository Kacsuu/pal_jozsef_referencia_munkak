using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.Interfaces
{
    public interface OperatorGenerator
    {
        List<Operator> Operators { get; }
    }
}
