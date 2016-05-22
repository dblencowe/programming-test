# Docnet Technical Test
## dblencowe


### The Idea
The idea behind this application is to implement a set of base classes. The actual shipping plugins then extend
these stubs and implement the actual logic in functions. That way when implementing the imp team only need to worry
about calling `startBatch`, `endBatch` and `addToManifest` functions.

The way I envisage this working is you would make a call like the following:
`$this->app->plugin->shipping->startBatch()`. The app would then handle running that for the appropriate plugins making
the module usable by anyone without knowing the inner workings.