using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PebbleGame.Interfaces
{
    public interface Operator
    {
        bool IsApplicable(State state);
        State Apply(State state);
    }
}
