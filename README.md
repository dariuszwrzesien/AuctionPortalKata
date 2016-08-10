[![Build Status](https://travis-ci.org/dariuszwrzesien/AuctionPortalKata.svg?branch=master)](https://travis-ci.org/dariuszwrzesien/AuctionPortalKata)
[![Coverage Status](https://coveralls.io/repos/github/dariuszwrzesien/AuctionPortalKata/badge.svg?branch=master)](https://coveralls.io/github/dariuszwrzesien/AuctionPortalKata?branch=master)

# FP PHP Kata 1

*Online Auctions (via IPC Berlin 2015)*

## Technical requirements

- PHP 7.0.x
- Composer (latest version)

## How to run?

```
$: composer install
$: composer tests
```

## Assumptions (acceptance criteria)

Implement the domain logic of an auction platform with the following business rules:

- Each user has a nickname and an e-mail address
- An auction has:
  - title and a description text,
  - start and an end time,
  - starting price (must be greater than 0)
- Every user can create auctions
- A user can bid on every auction
- Each bid must be at least that high and starting price and buy now price (if allowed)
- Bid must be at least one EUR higher than the previous bid
- Auctions must have an optional "buy now" feature which allows users to buy immediately at a pre-defined price. This price may be defined when auction is created and cannot be changed. The "buy now" price must be higher than the starting price
- The "buy now" feature can be activated for every running auction as long as no bids have been made
- If a user chooses to "buy now", this immediately ends the auction
- The auction ends automatically when the end time is reached
- One cannot bid on an auction that has ended; "buy now" is also Impossible
- User must be able to view a list of articles that they have sold and bought

## Important

1. Write only object-oriented code, ideally using a test-driven or test-first approach.
2. Write unit tests that achieve 100% line coverage. Name tests so that the testdox output of PHPUnit shows an executable specification of all business rules. Make sure every test has suitable @covers annotations.
3. Make sure application and domain logic are clearly separated. Do not write any persistence code, and do not write presentation code. We strongly suggest not to use any frameworks or libraries.
4. It is not important to deliver all features. Focus on the features with the highest business value and implement them first. Make sure that you deliver a working solution with features that are fully done. Consider using version control to ensure that you do not deliver anything that is uncompleted.
5. Only implement required features. Do not implement anything additional that has not been asked for.