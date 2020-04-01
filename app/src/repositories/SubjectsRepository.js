import Repository from './Repository';

class SubjectsRepository extends Repository {
  constructor () {
    super('/subjects')
  }
}

export default new SubjectsRepository();
