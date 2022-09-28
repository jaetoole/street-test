# Street Test
* * *
## Architectural Decisions
I've decided to use Laravel for this project. Whilst I could write this very minimal and pull in the odd Symfony component
which would be a good showcase of my core PHP knowledge, I feel like this takes away from the fact this is a Laravel role.
I also feel that Laravel doesn't introduce too much technical debt even for smaller projects.

I like to always try follow DDD wherever possible and so my preferred structure would be to split Application and Business logic.
I do this by creating a `src/Domain` directory in the project root directory. Then any business logic would sit within a sub-directory which
relates to its particular domain. Implementing that kind of structure here feels highly unnecessary.
Given this decision, I will keep all of my logic contained within the `App` directory.

I've also included PEST for testing. If you are interested on my thoughts on PEST, I think it's meh... It's useful for some things
but then I miss the intellisense of just using PHPUnit for all the custom Laravel assertions. 

I wanted to stick exactly to the 2 hours for building this so I haven't had time to refactor my really crappy (but working)
algorithm. The good thing is, because of how it is built, we can switch out the formatter and hide it!
I would have also liked to have brought in Termwind and made the terminal pretty because why not.

For my test structure, I believe Unit tests shouldn't touch the database. Any test that touches the Database should be a feature test.
I'm also aware that due to time constraints I couldn't implement the logic within the Factory to switch some records so some are
generated with initials and not first names etc.

I also know the job which imports the CSV file isn't tested. This is because that logic is tightly coupled. I've lost the
ability to pass in a stub which is my own fault. I did however make it so the actions the job uses can be mocked when I would
eventually add a unit test to the job.

Whilst writing this, I've also realised that my NameFormatter logic is actually just like the Factory pattern so I would
refactor that if I had more time.

I tend to over-engineer things in the first instance to get them working then I like to refactor them (and write more tests
as I know my TDD isn't perfect).

## Project Installation
Just to ensure cross-compatability, I've decided to use Laravel Sail instead of my own custom Docker setup for running this project.
Of course, you might be running Laravel Valet, in which case you're probably already up and running.

To start the project, please ensure you have Docker installed.
```shell
composer install
./vendor/bin/sail up -d
<usual laravel commands>
```

The entrypoint to this application is a command which will load. You will also need to ensure your queue driver is set to sync.
